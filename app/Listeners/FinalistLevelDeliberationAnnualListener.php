<?php

namespace App\Listeners;

use App\Models\Year;
use App\Models\Level;
use App\Models\Annual;
use App\Models\Student;
use App\Math\Capitalize;
use App\Query\QueryYear;
use App\Query\QueryDelibe;
use App\Models\Deliberated;
use App\Constraint\AnnualConstraint;
use Illuminate\Database\Eloquent\Collection;
use App\Events\FinalistLevelDeliberationAnnualEvent;

class FinalistLevelDeliberationAnnualListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(FinalistLevelDeliberationAnnualEvent $event): void
    {
        $year = QueryYear::currentYear();

        $level = QueryDelibe::findLevel(
            $event->programmeId,
            $year->id,
            $event->optionId,
        );

        $annual = QueryDelibe::newAnnual($year->id, $level->id);

        AnnualConstraint::hasDelibeSemesterExist($level, $annual);

        $deliberatedsAnnuals = $this->calculateDeliberations(
            $level->students,
            $annual
        );

        $newYear = QueryYear::nextYear();

        $this->assignStudentsToNewLevels(
            $deliberatedsAnnuals,
            $level->students,
            $newYear,
            $level
        );
    }

    private function calculateDeliberations(
        Collection $students,
        Annual $annual
    ): array {
        $deliberatedsAnnuals = [];

        foreach ($students as $student) {
            $deliberatedsAnnuals[$student->id] = $this->calculateStudentDelibe(
                $student,
                $annual
            );
        }

        return $deliberatedsAnnuals;
    }

    private function calculateStudentDelibe(
        Student $student,
        Annual $annual
    ): Deliberated {
        $total = 0;
        $pourcent = [];
        $mca = [];
        $mcb = [];
        $mab = [];
        $tn = 0;
        $tnp = 0;
        $ncc = 0;
        $tncc = 0;

        foreach ($student->deliberateds as $deliberated) {
            $total += $deliberated->total;
            $pourcent[] = $deliberated->pourcent;
            $mca[] = $deliberated->mca;
            $mcb[] = $deliberated->mcb;
            $ncc += $deliberated->ncc;
            $tncc += $deliberated->tncc;
            $tn += $deliberated->tn;
            $tnp += $deliberated->tnp;
            $mab[] = $deliberated->mab;
        }

        $validated = Capitalize::mention($ncc, $tncc);

        $decision = Capitalize::decision($ncc, $tncc);

        return new Deliberated([
            'pourcent' => moy($pourcent),
            'mca' => moy($mca),
            'mcb' => moy($mcb),
            'mab' => moy($mab),
            'ncc' => $ncc,
            'tncc' => $tncc,
            'tn' => $tn,
            'tnp' => $tnp,
            'total' => $total,
            'annual_id' => $annual->id,
            'student_id' => $student->id,
            'validated' => $validated,
            'decision' => $decision,
        ]);
    }


    private function assignStudentsToNewLevels(
        array $deliberatedsAnnuals,
        Collection $students,
        Year $newYear,
        Level $level
    ): void {

        $newLevelBasic = QueryDelibe::replyLevel($newYear, $level);

        foreach ($students as $student) {
            $deliberated = $deliberatedsAnnuals[$student->id];

            $deliberated->save();

            $this->assignStudentToLevel(
                $deliberated,
                $student,
                $newLevelBasic
            );
        }
    }

    private function assignStudentToLevel(
        Deliberated $deliberated,
        Student $student,
        Level $newLevelBasic,
    ): void {
        if ($deliberated->decision !== 'Admis') {
            $newLevelBasic->students()->attach([$student->id]);
        }
    }
}
