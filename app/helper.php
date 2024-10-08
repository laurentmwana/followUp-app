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

    $levels = Level::with(['students', 'option'])
        ->whereYearId(QueryYear::currentYear()->id)
        ->whereProgrammeId($programmeId)->get();

    if (null === $levels) return [];

    foreach ($levels as $level) {
        foreach ($level->students as $student) {
            $value = "{$student->name} {$student->firstname} | {$level->option->alias}";
            $items[$student->id] = $value;
        }
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

function age(string $happy): string
{
    $year = (int)(new \DateTime($happy))->format('Y');

    $age = (int)date('Y') - $year;

    return $age . ' ans';
}



function currentYearLevel(): array
{
    $year = currentYear();

    $levels =  Level::with(['option', 'programme'])
        ->whereYearId($year->id)
        ->get();

    $levelsArray = [];

    foreach ($levels as $level) {
        $levelName = "{$level->programme->name} {$level->option->name}";
        $levelsArray[$level->id] = $levelName;
    }

    return $levelsArray;
}
