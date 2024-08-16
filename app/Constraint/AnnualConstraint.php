<?php

namespace App\Constraint;

use App\Models\Level;
use App\Models\Annual;
use App\Models\Deliberated;
use App\Models\Deliberation;
use Symfony\Component\HttpFoundation\Response;

abstract class AnnualConstraint
{
    public static function hasDelibeSemesterExist(Level $level, Annual $annual): void
    {
        $students = $level->students();

        if ($annual !== null) {
            self::checkForExistingDeliberation($students, $annual);
        }

        $deliberations = self::getDeliberationsForLevel($level);

        if (!empty($deliberations)) {
            self::checkSemesterDeliberationsCompleted($students, $deliberations);
        }
    }

    private static function checkForExistingDeliberation($students, Annual $annual): void
    {
        $studentExist = Deliberated::whereIn(
            'student_id',
            $students->pluck('id')->toArray()
        )
            ->whereNull('deliberation_id')
            ->whereIn('annual_id', [$annual->id])->first();

        if ($studentExist !== null) {
            abort(Response::HTTP_FORBIDDEN, "Vous ne pouvez pas effectuer la délibération annuelle deux fois.");
        }
    }

    private static function getDeliberationsForLevel(Level $level): array
    {
        return Deliberation::whereLevelId($level->id)->pluck('id')->toArray();
    }

    private static function checkSemesterDeliberationsCompleted($students, array $deliberations): void
    {
        $delibeCount = Deliberated::whereIn(
            'student_id',
            $students->pluck('id')->toArray()
        )->whereIn('deliberation_id', $deliberations)->count('id');

        if ($delibeCount !== ($students->count() * 2)) {
            abort(
                Response::HTTP_FORBIDDEN,
                "Commencez par effectuer la délibération pour les deux semestres, puis procédez à la délibération annuelle."
            );
        }
    }
}
