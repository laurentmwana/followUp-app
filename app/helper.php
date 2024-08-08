<?php

use App\Enums\RoleEnum;
use App\Math\MoyGroup;
use Illuminate\Database\Eloquent\Collection;

define('ARRAY_SEXIES', [
    'M' => 'Homme',
    'F' => 'Femme',
]);

/**
 * @param string $role
 * @return bool
 */
function isAdmin(string $role): bool
{
    return $role === RoleEnum::ROLE_ADMIN->value;
}

/**
 * @param string $role
 * @return bool
 */
function isStudent(string $role): bool
{
    return $role === RoleEnum::ROLE_STUDENT->value;
}

function okNote(int | float $number, int $min = 10, int $max = 20): bool
{
    return ($number > 0 && $number >= $min) && $number <= $max;
}

function moyGroupCourse(Collection $courses): MoyGroup
{
    return (new MoyGroup($courses))->calcul();
}


function moy(array $numbers): float | int
{
    return floor(array_sum($numbers) / count($numbers));
}

/**
 * @param int $number
 * @return string
 */
function formatNumber(int $number): string
{
    if ($number < 1000) {
        return $number;
    } elseif ($number < 1000000) {
        return number_format($number / 1000, 1) . 'K';
    } elseif ($number < 1000000000) {
        return number_format($number / 1000000, 1) . 'M';
    } else {
        return number_format($number / 1000000000, 1) . 'B';
    }
}


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
