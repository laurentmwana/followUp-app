<?php


namespace App\Math;

use App\Enums\DecisionEnum;

abstract class Capitalize
{
    private const LIMIT = 45;

    public static function ok(int $ncc, int $tncc): bool
    {
        return ($ncc >= self::LIMIT && $ncc <= $tncc) || $ncc === $tncc;
    }

    public static function mention(int $ncc, int $tncc): string
    {
        $ok = self::ok($ncc, $tncc);

        return $ok ? 'V' : 'NV';
    }

    public static function decision(int $ncc, int $tncc): string
    {
        $ok = self::ok($ncc, $tncc);

        return $ok
            ? DecisionEnum::DECISION_ADMITTED->value
            : DecisionEnum::DECISION_RETAKE->value;
    }
}
