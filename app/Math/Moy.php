<?php


namespace App\Math;

abstract class Moy
{
    public static function moyPond(array $group): float | int
    {
        $numerator = array_sum(array_map(fn($c) => $c['tnp'], $group));
        $denominator = array_sum(array_map(fn($c) => $c['credits'], $group));

        return $denominator !== 0
            ? floor($numerator / $denominator)
            : 0;
    }

    public static function calculateSumPonderation(array $group): array
    {
        return [
            array_sum(array_map(fn($c) => $c['tnp'], $group)),
            array_sum(array_map(fn($c) => $c['credits'] * 20, $group)),
            array_sum(array_map(fn($c) => $c['credits'], $group)),
        ];
    }


    public static function numberCreditsCapitalize(array $groupsCollection): array
    {
        $ncc =  0;
        $tncc =  0;
        $np = 0;
        foreach ($groupsCollection as $groups) {
            [$tn, $tnp, $tp] = self::calculateSumPonderation($groups);

            if ($tn >= ($tnp / 2) && $tn <= $tnp) $ncc += $tp;

            $tncc += $tp;
            $np += $tn;
        }
        return [$ncc, $tncc, $np];
    }
}
