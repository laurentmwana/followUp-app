<?php


use App\Enums\RoleEnum;

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
