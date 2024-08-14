<?php

namespace App\Constraint;

use App\Models\Note;
use App\Models\Level;
use App\Models\Semester;
use Symfony\Component\HttpFoundation\Response;

abstract class DeliberationSemesterConstraint
{
    public static function hasDelibeExist(Level $level, string $semesterId): void
    {
        $deliberation =  $level->deliberations()
            ->whereSemesterId($semesterId);

        if (
            $deliberation->exists() &&
            $deliberation
            ->first()
            ->deliberateds()
            ->count()
        ) {
            abort(Response::HTTP_FORBIDDEN, "La délibération a déjà été effectuée, vous ne pouvez pas la faire deux fois.");
        }
    }

    public static function hasNoteStudentExist(Level $level, Semester $semester): void
    {
        $courses = $semester->courses();
        $students = $level->students();

        $notes = Note::whereIn('student_id', $level->students()->pluck('id'))
            ->whereSemesterId($semester->id)
            ->whereYearId($level->year_id)
            ->whereIn('group_id', $semester->groups()->pluck('id'))
            ->get();

        if ($notes->count() === 0) {
            abort(Response::HTTP_FORBIDDEN, "Chaque étudiant doit avoir une note, car la délibération se basera sur ces notes.");
        }

        $limitNote = $courses->count() * $students->count();

        if ($notes->count() <  $limitNote) {
            abort(Response::HTTP_FORBIDDEN, "Certains étudiants n'ont pas de note. Veuillez vous assurer que tous les étudiants en ont.");
        }
    }
}
