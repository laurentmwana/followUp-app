<?php

namespace App\Listeners;

use App\Constraint\DeliberationAnnualConstraint;
use App\Models\Note;
use App\Models\Level;
use App\Models\Choice;
use App\Math\Capitalize;
use App\Models\Semester;
use App\Query\QueryYear;
use App\Query\QueryDelibe;
use App\Models\Deliberated;
use App\Models\Deliberation;
use App\Events\ProgrammeBasicAnnualEvent;
use App\Constraint\DeliberationSemesterConstraint;
use Symfony\Component\HttpFoundation\Response;

class ProgrammeBasicAnnualListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(ProgrammeBasicAnnualEvent $event): void
    {
        $year = QueryYear::currentYear();
        $level = QueryDelibe::findLevel($event->programmeId, $year->id);

        DeliberationAnnualConstraint::hasDelibeSemesterExist($level);

        $annual = QueryDelibe::newAnnual($year->id, $level->id);

        $deliberatedsAnnuals = [];

        $students = $level->students;

        foreach ($students as $student) {
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

            $validated =  Capitalize::ok($ncc, $tncc) ? 'V' : 'NV';
            $decision = Capitalize::ok($ncc, $tncc) ? 'Admis' : 'Reprend';

            $deliberatedsAnnuals[$student->id] = new Deliberated([
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

        $newYear = QueryYear::newYear();

        $newLevelBasic = QueryDelibe::newLevelBasic($newYear, $level);
        $newLevelInfo = QueryDelibe::newLevelInfo($newYear);
        $newLevelMathStat = QueryDelibe::newLevelMathStat($newYear);

        foreach ($students as $student) {
            $deliberated = $deliberatedsAnnuals[$student->id];

            $deliberatedsAnnuals[$student->id]->save();

            if ($deliberated->decision === 'Admis') {
                $choice = Choice::whereStudentId($student->id)->first();

                if ($choice->option_id === 2) {
                    $newLevelMathStat->students()->sync([$student->id]);
                } elseif ($choice->option_id === 3) {
                    $newLevelInfo->students()->sync([$student->id]);
                }
            } else {
                $newLevelBasic->students()->sync([$student->id]);
            }
        }
    }
}
