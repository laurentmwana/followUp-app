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
use App\Events\SecondLevelDeliberationAnnualEvent;

class SecondLevelDeliberationAnnualListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(SecondLevelDeliberationAnnualEvent $event): void
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
        $mca = 0;
        $mcb = 0;
        $tn = 0;
        $tnp = 0;
        $mab = [];
        $ncc = 0;
        $tncc = 0;

        foreach ($student->deliberateds as $deliberated) {
            $total += $deliberated->total;
            $pourcent[] = $deliberated->pourcent;
            $mca += $deliberated->mca;
            $mcb += $deliberated->mcb;
            $ncc += $deliberated->ncc;
            $tncc += $deliberated->tncc;
            $tn += $deliberated->tn;
            $tnp += $deliberated->tnp;
            $mab[] = $deliberated->mab;
        }

        $p = floor(array_sum($pourcent) / count($pourcent));
        $mc = floor(array_sum($mab) / count($mab));

        $validated = Capitalize::mention($ncc, $tncc);
        $decision = Capitalize::decision($ncc, $tncc);

        return new Deliberated([
            'pourcent' => $p,
            'mca' => $mca,
            'mcb' => $mcb,
            'mab' => $mc,
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

        $newLevelInfo = QueryDelibe::newLevelInfo($newYear, 3);
        $newLevelMathStat = QueryDelibe::newLevelMathStat($newYear, 3);

        foreach ($students as $student) {
            $deliberated = $deliberatedsAnnuals[$student->id];

            $deliberated->save();

            $this->assignStudentToLevel(
                $deliberated,
                $student,
                $newLevelBasic,
                $newLevelInfo,
                $newLevelMathStat,
                $level
            );
        }
    }

    private function assignStudentToLevel(
        Deliberated $deliberated,
        Student $student,
        Level $newLevelBasic,
        Level $newLevelInfo,
        Level $newLevelMathStat,
        Level $level
    ): void {
        if ($deliberated->decision === 'Admis') {
            if ($level->option_id === 2) {
                $newLevelMathStat->students()->attach([$student->id]);
            } elseif ($level->option_id === 3) {
                $newLevelInfo->students()->attach([$student->id]);
            }
        } else {
            $newLevelBasic->students()->attach([$student->id]);
        }
    }
}
