<?php


use App\Enums\RoleEnum;
use App\Math\MoyGroup;
use Illuminate\Database\Eloquent\Collection;

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
