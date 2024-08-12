<?php

namespace App\Constraint;

use App\Models\Note;
use App\Models\Course;
use App\Models\Deliberation;
use Symfony\Component\HttpFoundation\Response;

abstract class NoteConstraint
{
    public static function hasNoteStudentExist(Note $note)
    {

        $deliberation = Deliberation::with(['deliberateds'])
            ->whereSemesterId($note->semester_id)
            ->whereYearId($note->year_id)
            ->first();

        if (
            null !== $deliberation &&
            $deliberation->deliberateds->contains('student_id', $note->student_id)
        ) {
            abort(Response::HTTP_FORBIDDEN, "Vous ne pouvez pas modifier une note, alors que la délibération a commencé.");
        }
    }

    public static function noCreateNoteForStudent(array $attributes, Course $course)
    {
        $deliberation = Deliberation::with(['deliberateds'])
            ->whereSemesterId($course->semester_id)
            ->whereYearId($attributes['year_id'])
            ->first();

        if (
            (null !== $deliberation &&
                $deliberation->deliberateds
                ->contains('student_id', $attributes['student_id']))
        ) {
            abort(Response::HTTP_FORBIDDEN, "Vous ne pouvez pas ajouter une note, alors que la délibération a commencé.");
        }

        $hasNote = $course->notes->contains('student_id', $attributes['student_id']);

        if ($hasNote) {
            abort(Response::HTTP_FORBIDDEN, "Vous ne pouvez pas ajouter une note, alors que la délibération a commencé.");
        }
    }

    public static function noDeleteNoteForStudent(Note $note)
    {
        $deliberation = Deliberation::with(['deliberateds'])
            ->whereSemesterId($note->semester_id)
            ->whereYearId($note->year_id)
            ->first();

        if (
            null !== $deliberation &&
            $deliberation->deliberateds->contains('student_id', $note->student_id)
        ) {
            abort(Response::HTTP_FORBIDDEN, "Vous ne pouvez pas supprimer une note, alors que la délibération a commencé.");
        }
    }
}
