<?php

namespace App\Query;

use App\Exceptions\YearIsNotClosedException;
use App\Models\Year;
use App\Models\Level;
use App\Models\Annual;
use App\Models\Decision;
use App\Models\Semester;
use App\Enums\DecisionEnum;
use App\Models\Deliberation;
use Illuminate\Database\Eloquent\Collection;

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

    public static function findLevel(string $programmeId, int $yearId, int $optionId): Level
    {
        $l = Level::with(['students'])
            ->whereProgrammeId($programmeId)
            ->whereOptionId($optionId)
            ->whereYearId($yearId)->first();

        if ($l === null) {
            throw new YearIsNotClosedException(
                $programmeId
            );
        }

        $level =  Level::with([
            'students',
            'students.notes' => function ($query) use ($l) {
                return $query
                    ->where('year_id', '=', $l->year_id)
                    ->whereIn('student_id', $l->students->pluck('id')->toArray());
            },
            'deliberations' => function ($query) use ($l) {
                return $query
                    ->where('year_id', '=', $l->year_id)
                    ->where('level_id', '=', $l->id);
            },
            'deliberations.deliberateds',
            'students.notes.group',
            'students.notes.student',
        ])->find($l->id);

        if ($level === null) {
            throw new YearIsNotClosedException(
                $programmeId
            );
        }

        return $level;
    }

    public static function findAllLevel(string $programmeId, int $yearId): Collection
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
            ->get();
    }

    public static function newDeliberation(int $yearId, ?int $semesterId, int $levelId): Deliberation
    {
        $deliberation  =  Deliberation::whereLevelId($levelId)
            ->whereSemesterId($semesterId)
            ->whereYearId($yearId)
            ->first();

        return null === $deliberation
            ? Deliberation::create([
                'level_id' => $levelId,
                'semester_id' => $semesterId,
                'year_id' => $yearId,
            ])
            : $deliberation;
    }


    public static function newAnnual(int $yearId, int $levelId): Annual
    {
        $annual  =  Annual::whereLevelId($levelId)
            ->whereYearId($yearId)
            ->first();

        return null === $annual
            ? Annual::create([
                'level_id' => $levelId,
                'year_id' => $yearId,
            ])
            : $annual;
    }

    public static function newLevelBasic(Year $year, Level $level): Level
    {
        $newBasicYear = Level::whereYearId($year->id)
            ->whereOptionId($level->option_id)
            ->whereProgrammeId($level->programme_id)
            ->first();

        return $newBasicYear === null
            ? Level::create([
                'year_id' => $year->id,
                'programme_id' => $level->programme_id,
                'option_id' => $level->option_id,
            ])
            : $newBasicYear;
    }

    public static function replyLevel(Year $year, Level $level): Level
    {
        $l = Level::whereYearId($year->id)
            ->whereOptionId($level->option_id)
            ->whereProgrammeId($level->programme_id)
            ->first();

        return $l === null
            ? Level::create([
                'year_id' => $year->id,
                'programme_id' => $level->programme_id,
                'option_id' => $level->option_id,
            ])
            : $level;
    }


    public static function newLevelInfo(
        Year $year,
        int $nextProgramme = 2
    ): Level {
        $level = Level::whereYearId($year->id)
            ->whereOptionId(3)
            ->whereProgrammeId($nextProgramme)
            ->first();

        return $level === null
            ? Level::create([
                'year_id' => $year->id,
                'programme_id' => $nextProgramme,
                'option_id' => 3,
            ])
            : $level;
    }

    public static function newLevelMathStat(
        Year $year,
        int $nextProgramme = 2

    ): Level {
        $newBasicYear = Level::whereYearId($year->id)
            ->whereOptionId(2)
            ->whereProgrammeId($nextProgramme)
            ->first();

        return $newBasicYear === null
            ? Level::create([
                'year_id' => $year->id,
                'programme_id' => $nextProgramme,
                'option_id' => 2,
            ])
            : $newBasicYear;
    }
}
