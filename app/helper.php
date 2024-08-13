<?php

use App\Models\Year;
use App\Models\Level;
use App\Models\Course;
use App\Models\Option;
use App\Query\QueryYear;
use Illuminate\Database\Eloquent\Collection;

/**
 * @param Illuminate\Database\Eloquent\Collection $collection<int, Level>
 * @return array
 */
function formatLevelToProgramme(Collection $collection): array
{
    $items = [];

    foreach ($collection as $level) {
        $programme = $level->programme;
        $option = $level->option;
        $year = $level->year;

        $value = "{$programme->alias} {$option->alias} {$year->start}-{$year->end}";
        $id = $level->id;

        $items[$id] = $value;
    }

    return $items;
}


function formatProgramme(Collection $collection): array
{
    $items = [];

    foreach ($collection as $programme) {
        $value = "{$programme->alias} ~ {$programme->name}";
        $items[$programme->id] = $value;
    }

    return $items;
}

function formatLevelToStudent(?string $programmeId): array
{
    if (null === $programmeId) return [];

    $items = [];

    $level = Level::with(['students'])
        ->whereYearId(QueryYear::currentYear()->id)
        ->whereProgrammeId($programmeId)->first();
    if (null === $level) return [];

    foreach ($level->students as $student) {
        $value = "{$student->name} {$student->fristname}";
        $items[$student->id] = $value;
    }

    return $items;
}


function formatCourseToGroup(?string $semesterId): array
{
    if (null === $semesterId) return [];

    $items = [];

    $courses = Course::with(['group'])->whereSemesterId($semesterId)->get();

    if ($courses->count() === 0) return [];

    foreach ($courses as $course) {
        $value = "{$course->name} | {$course->credits} crédit(s)";
        $items[$course->id] = $value;
    }

    return $items;
}

function formatOptions(): array
{
    $items = [];

    $options = Option::where('id', '>', 1)->get(['id', 'name', 'alias']);

    foreach ($options as $option) {
        $items[$option->id] = $option->name;
    }

    return $items;
}


function currentYear(): Year
{
    return QueryYear::currentYear();
}
