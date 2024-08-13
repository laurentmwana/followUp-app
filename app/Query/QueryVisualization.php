<?php

namespace App\Query;

use App\Models\Student;

abstract class QueryVisualization
{
    public static function findStudents(
        ?string $programmeId,
        ?string $semesterId,
        string $studentId
    ): Student {
        $checkLevelSelect = function ($query) use ($programmeId) {
            if (null === $programmeId || empty($programmeId)) return $query;
            return $query->where('programme_id', '=', $programmeId);
        };

        $checkDelibe = function ($query) use ($studentId) {
            return $query->where('student_id', '=', $studentId);
        };

        $checkSemester = function ($query) use ($semesterId) {
            if (null === $semesterId || empty($semesterId)) return $query;
            return $query->whereIn('id', [$semesterId]);
        };

        $checkStudentNote = function ($query) use ($studentId) {
            return $query->where('student_id', '=', $studentId);
        };

        return Student::with([
            'levels.year',
            'levels.annuals',
            'levels.annuals.deliberateds' => $checkDelibe,
            'levels' => $checkLevelSelect,
            'levels.programme',
            'levels.option',
            'levels.programme.semesters' => $checkSemester,
            'levels.programme.semesters.deliberations',
            'levels.programme.semesters.deliberations.deliberateds' => $checkDelibe,
            'levels.programme.semesters.groups',
            'levels.programme.semesters.groups.category',
            'levels.programme.semesters.groups.notes.course',
            'levels.programme.semesters.groups.notes' => $checkStudentNote
        ])->find($studentId);
    }
}
