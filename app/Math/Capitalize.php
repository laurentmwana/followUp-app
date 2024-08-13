<?php


namespace App\Math;

abstract class Capitalize
{
    private const LIMIT = 45;

    public static function ok(int $ncc, int $tncc): bool
    {
        return $ncc >= self::LIMIT && $ncc <= $tncc;
    }
}
