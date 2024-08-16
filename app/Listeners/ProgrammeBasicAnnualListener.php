<?php

namespace App\Listeners;

use App\Constraint\AnnualConstraint;
use App\Models\Choice;
use App\Math\Capitalize;
use App\Query\QueryYear;
use App\Query\QueryDelibe;
use App\Models\Deliberated;
use App\Events\DeliberationAnnualEvent;

class ProgrammeBasicAnnualListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(DeliberationAnnualEvent $event): void
    {
        $year = QueryYear::currentYear();
        $level = QueryDelibe::findLevel(
            $event->programmeId,
            $year->id
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

    private function calculateDeliberations($students, $annual): array
    {
        $deliberatedsAnnuals = [];

        foreach ($students as $student) {
            $deliberatedsAnnuals[$student->id] = $this->calculateStudentDelibe(
                $student,
                $annual
            );
        }

        return $deliberatedsAnnuals;
    }

    private function calculateStudentDelibe($student, $annual): Deliberated
    {
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


    private function assignStudentsToNewLevels(array $deliberatedsAnnuals, $students, $newYear, $level): void
    {
        $newLevelBasic = QueryDelibe::newLevelBasic($newYear, $level);
        $newLevelInfo = QueryDelibe::newLevelInfo($newYear);
        $newLevelMathStat = QueryDelibe::newLevelMathStat($newYear);

        foreach ($students as $student) {
            $deliberated = $deliberatedsAnnuals[$student->id];

            $deliberated->save();

            $this->assignStudentToLevel(
                $deliberated,
                $student,
                $newLevelBasic,
                $newLevelInfo,
                $newLevelMathStat
            );
        }
    }

    private function assignStudentToLevel(
        $deliberated,
        $student,
        $newLevelBasic,
        $newLevelInfo,
        $newLevelMathStat
    ): void {
        if ($deliberated->decision === 'Admis') {
            $choice = Choice::whereStudentId($student->id)->first();

            if ($choice->option_id === 2) {
                $newLevelMathStat->students()->attach([$student->id]);
            } elseif ($choice->option_id === 3) {
                $newLevelInfo->students()->attach([$student->id]);
            }
        } else {
            $newLevelBasic->students()->attach([$student->id]);
        }
    }
}
