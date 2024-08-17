<?php

namespace App\Constraint;

use App\Models\Level;
use App\Models\Annual;
use App\Models\Deliberated;
use App\Models\Deliberation;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

abstract class AnnualConstraint
{
    public static function hasDelibeSemesterExist(
        Level $level,
        Annual $annual
    ): void {

        /**
         * @var Collection
         */
        $students = $level->students;

        if ($annual !== null) {
            self::checkForExistingDeliberation($students, $annual);
        }

        $deliberations = self::getDeliberationsForLevel($level);

        if (empty($deliberations)) {
            abort(
                Response::HTTP_FORBIDDEN,
                "Commencez par effectuer la délibération pour les deux semestres, puis procédez à la délibération annuelle."
            );
        }

        self::checkSemesterDeliberationsCompleted($students, $deliberations);
    }

    private static function checkForExistingDeliberation(
        Collection $students,
        Annual $annual
    ): void {

        $countDeliberateds = $annual->deliberateds->count();

        $studentsInDeliberateds = $annual->deliberateds()
            ->whereIn(
                'student_id',
                $students->pluck('id')->toArray()
            )->count('id');

        if (
            ($countDeliberateds !== 0 || $studentsInDeliberateds !== 0)
        ) {
            abort(Response::HTTP_FORBIDDEN, "Vous ne pouvez pas effectuer la délibération annuelle deux fois.");
        }
    }

    private static function getDeliberationsForLevel(Level $level): array
    {
        return Deliberation::whereLevelId($level->id)
            ->whereYearId($level->year_id)
            ->pluck('id')->toArray();
    }

    private static function checkSemesterDeliberationsCompleted($students, array $deliberations): void
    {
        $delibeCount = Deliberated::whereIn(
            'student_id',
            $students->pluck('id')->toArray()
        )->whereIn('deliberation_id', $deliberations)->count('id');

        $deliberatedsCount = ($students->count() * 2);

        if ($delibeCount !== $deliberatedsCount) {
            abort(
                Response::HTTP_FORBIDDEN,
                "Commencez par effectuer la délibération pour les deux semestres, puis procédez à la délibération annuelle."
            );
        }
    }
}
