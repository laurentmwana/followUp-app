<?php

namespace App\Constraint;

use App\Models\Note;
use App\Models\Level;
use App\Models\Annual;
use App\Models\Semester;
use App\Models\Deliberated;
use App\Models\Deliberation;
use Symfony\Component\HttpFoundation\Response;

abstract class DeliberationAnnualConstraint
{
    public static function hasDelibeSemesterExist(Level $level): void
    {
        $annual = Annual::whereLevelId($level->id)->first();

        $students = $level->students();

        if ($annual !== null) {

            $studentExist = Deliberated::whereIn(
                'student_id',
                $students->get(['id']),
            )->whereAnnualId($annual->id);

            if ($studentExist->first() !== null) {
                abort(Response::HTTP_FORBIDDEN, "Vous ne pouvez pas effectuer la
                délibération annuelle deux fois.");
            }
        }

        $deliberations = Deliberation::whereLevelId($level->id)
            ->pluck('id')->toArray();

        if ($deliberations !== null) {
            $delibe = Deliberated::whereIn(
                'student_id',
                $students->get(['id'])->pluck('id')->toArray()
            )->whereIn('deliberation_id', $deliberations)->count('id');

            if ($delibe !== ($students->count() * 2)) {
                abort(
                    Response::HTTP_FORBIDDEN,
                    "Commencez par effectuer la délibération
                     pour les semestres 1 et 2, puis procédez à
                     la délibération annuelle."
                );
            }
        }
    }
}
