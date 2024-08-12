<?php

namespace App\Query;

use App\Enums\DecisionEnum;
use App\Models\Decision;
use App\Models\Level;
use App\Models\Semester;

abstract class QueryDelibe
{
    public static function findSemester(string $id)
    {
        return Semester::with([
            'programme',
            'programme.levels',
            'groups',
            'groups.courses',
            'groups.courses.notes',
            'groups.courses.notes.student',
            'groups.courses.notes.student',
            'groups.courses.notes.year',
        ])->find($id);
    }

    public static function findLevel(string $programmeId, int $yearId): Level
    {
        return Level::with([
            'students',
            'students.notes',
            'deliberations',
            'deliberations.deliberateds',
            'students.notes.group',
            'students.notes.student',
        ])->whereProgrammeId($programmeId)
            ->whereYearId($yearId)
            ->first();
    }

    public static function decision(float|int $pourcent): string
    {
        return "";
    }
}
