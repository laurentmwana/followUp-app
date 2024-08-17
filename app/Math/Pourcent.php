<?php


namespace App\Math;


abstract class Pourcent
{
    public static function p(int | float $min, int | float $max): float
    {
        return floor(($min / $max) * 100);
    }
}
