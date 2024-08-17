<?php

namespace App\Constraint;

use App\Models\Note;
use App\Models\Level;
use App\Models\Semester;
use Symfony\Component\HttpFoundation\Response;

abstract class SemesterConstraint
{
    public static function hasDelibeExist(
        Level $level,
        string $semesterId
    ): void {
        if (self::deliberationExistsForLevelAndSemester($level, $semesterId)) {
            abort(Response::HTTP_FORBIDDEN, "La délibération a déjà été effectuée, vous ne pouvez pas la faire deux fois.");
        }
    }

    public static function hasNoteStudentExist(
        Level $level,
        Semester $semester
    ): void {
        $notesCount = self::countNotesForLevelAndSemester($level, $semester);
        $expectedNotesCount = self::calculateExpectedNotesCount($level, $semester);

        if ($notesCount === 0) {
            abort(Response::HTTP_FORBIDDEN, "Pour pouvoir délibérer, chaque étudiant doit avoir une note.");
        }

        if ($notesCount < $expectedNotesCount) {
            abort(Response::HTTP_FORBIDDEN, "Certains étudiants n'ont pas de note. Veuillez vous assurer que tous les étudiants en ont.");
        }
    }

    private static function deliberationExistsForLevelAndSemester(
        Level $level,
        string $semesterId
    ): bool {
        return $level->deliberations()->whereSemesterId($semesterId)->exists();
    }

    private static function countNotesForLevelAndSemester(
        Level $level,
        Semester $semester
    ): int {
        return Note::whereIn('student_id', $level->students()->pluck('id'))
            ->whereSemesterId($semester->id)
            ->whereYearId($level->year_id)
            ->whereIn('group_id', $semester->groups()->pluck('id'))
            ->count();
    }

    private static function calculateExpectedNotesCount(
        Level $level,
        Semester $semester
    ): int {
        return $semester->courses()->count() * $level->students()->count();
    }
}
