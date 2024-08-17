<?php

namespace App\Listeners;

use App\Math\Moy;
use App\Models\Note;
use App\Models\Group;
use App\Models\Level;
use App\Math\Pourcent;
use App\Models\Student;
use App\Math\Capitalize;
use App\Models\Semester;
use App\Query\QueryYear;
use App\Query\QueryDelibe;
use App\Models\Deliberation;
use App\Constraint\SemesterConstraint;
use App\Events\DeliberationSemesterEvent;
use Symfony\Component\HttpFoundation\Response;

class DeliberationSemesterListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(DeliberationSemesterEvent $event): void
    {
        $year = QueryYear::currentYear();

        $level = QueryDelibe::findLevel(
            $event->programmeId,
            $year->id,
            $event->optionId,
        );

        $semester = QueryDelibe::findSemester($event->semesterId);

        SemesterConstraint::hasNoteStudentExist($level, $semester);

        SemesterConstraint::hasDelibeExist($level, $event->semesterId);

        $deliberation = QueryDelibe::newDeliberation($year->id, $semester->id, $level->id);

        foreach ($level->students as $student) {
            $this->processStudentDeliberation(
                $student,
                $semester,
                $deliberation
            );
        }
    }

    private function processStudentDeliberation(
        Student $student,
        Semester $semester,
        Deliberation $deliberation
    ): void {
        $tn = $tnp = $total = 0;

        $notes = Note::with(['course', 'group'])
            ->whereSemesterId($semester->id)
            ->whereStudentId($student->id)
            ->whereYearId($deliberation->year_id)
            ->get();

        $categoryA = [];
        $categoryB = [];

        $groups = [];

        $tnpIncrement  = 0;


        foreach ($notes as $note) {

            $tn += $note->note;
            $tnpIncrement = ($note->note * $note->course->credits);


            if ($note->group->category_id === 1) {
                $categoryA[] = [
                    'credits' => $note->course->credits,
                    'tnp' => $tnpIncrement,
                ];
            }

            if ($note->group->category_id === 2) {
                $categoryB[] = [
                    'credits' => $note->course->credits,
                    'tnp' => $tnpIncrement,
                ];
            }

            $groups[$note->group->id][] = [
                'credits' => $note->course->credits,
                'tnp' => $tnpIncrement,
            ];
        }

        $meanA = Moy::moyPond($categoryA);
        $meanB = Moy::moyPond($categoryB);
        $meanAB = moy([$meanA, $meanB]);

        [$ncc, $tncc, $tnp] = Moy::numberCreditsCapitalize($groups);

        $total = ($tncc * 20);

        $pourcent = Pourcent::p($tnp, $total);

        $this->createDeliberatedRecord(
            $deliberation,
            $student->id,
            $meanA,
            $meanB,
            $meanAB,
            $total,
            $tnp,
            $tn,
            $tncc,
            $ncc,
            $pourcent
        );


        // foreach ($semester->groups as $group) {
        //     $groupData = $this->calculateGroupData($group, $student);
        //     $tn += $groupData['mean'];
        //     $tnp += $groupData['tnp'];
        //     $total += $groupData['total'];
        //     $tncc += $groupData['tncc'];
        //     $ncc += $groupData['ncc'];

        //     $group->category->name === 'A'
        //         ? $mca[] = $groupData['mean']
        //         : $mcb[] = $groupData['mean'];
        // }

        // $meanA = $this->calculateMean($mca);
        // $meanB = $this->calculateMean($mcb);
        // $meanAB = floor(($meanA + $meanB) / 2);
        // $pourcent = Pourcent::p($tnp, $total);

        // $this->createDeliberatedRecord(
        //     $deliberation,
        //     $student->id,
        //     $meanA,
        //     $meanB,
        //     $meanAB,
        //     $total,
        //     $tnp,
        //     $tn,
        //     $tncc,
        //     $ncc,
        //     $pourcent
        // );
    }

    private function createDeliberatedRecord(
        Deliberation $deliberation,
        int $studentId,
        int $meanA,
        int $meanB,
        int $meanAB,
        int $total,
        int $tnp,
        int $tn,
        int $tncc,
        int $ncc,
        int $pourcent
    ): void {

        $validated =  Capitalize::mention($ncc, $tncc);

        $deliberation->deliberateds()->create([
            'mca' => $meanA,
            'mcb' => $meanB,
            'mab' => $meanAB,
            'total' => $total,
            'tnp' => $tnp,
            'tn' => $tn,
            'tncc' => $tncc,
            'ncc' => $ncc,
            'pourcent' => $pourcent,
            'student_id' => $studentId,
            'validated' => $validated,
        ]);
    }
}
