<?php

namespace App\Listeners;

use App\Models\Note;
use App\Models\Level;
use App\Math\Capitalize;
use App\Models\Semester;
use App\Query\QueryYear;
use App\Query\QueryDelibe;
use App\Models\Deliberation;
use App\Constraint\SemesterConstraint;
use App\Events\DeliberationSemesterEvent;
use Symfony\Component\HttpFoundation\Response;

class ProgrammeBasicListener
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
            $this->processStudentDeliberation($student, $semester, $level, $deliberation);
        }
    }

    private function processStudentDeliberation($student, $semester, $level, $deliberation): void
    {
        $tn = $tnp = $total = $tncc = $ncc = 0;
        $mca = $mcb = [];

        foreach ($semester->groups as $group) {
            $groupData = $this->calculateGroupData($group, $student);
            $tn += $groupData['mean'];
            $tnp += $groupData['tnp'];
            $total += $groupData['total'];
            $tncc += $groupData['tncc'];
            $ncc += $groupData['ncc'];

            $group->category->name === 'A'
                ? $mca[] = $groupData['mean']
                : $mcb[] = $groupData['mean'];
        }

        $meanA = $this->calculateMean($mca);
        $meanB = $this->calculateMean($mcb);
        $meanAB = floor(($meanA + $meanB) / 2);
        $pourcent = floor(($tnp / $total) * 100);

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
    }

    private function calculateGroupData($group, $student): array
    {
        $credits = $group->courses->sum('credits');
        $tnp = 0;
        $groupNotes = [];
        $ncc = 0;
        $tncc = 0;

        foreach ($group->courses as $course) {
            foreach ($course->notes->where('student_id', $student->id) as $note) {
                $groupNotes[] = $note->note;
                $tnp += $note->note * $course->credits;
            }
        }

        $mean = ($credits > 0 && count($groupNotes) > 0) ? floor(array_sum($groupNotes) / $credits) : 0;
        $total = 20 * $credits;
        $tncc += $credits;
        if ($tnp >= ($total / 2) && $tnp <= $total) $ncc += $credits;

        return compact('tncc', 'ncc', 'total', 'mean', 'tnp');
    }

    private function calculateMean(array $scores): int
    {
        return count($scores) > 0
            ? floor(array_sum($scores) / count($scores))
            : 0;
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
