<?php


namespace App\Query;

use App\Models\Deliberation;
use App\Models\Year;

abstract class QueryYear
{
    /**
     * Permet de récupèrer l'année en cours
     * @return \App\Models\Year
     */
    public static function currentYear(): Year
    {
        return Year::whereState(0)
            ->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->first();
    }

    public static function nextYear(): Year
    {
        $year = self::currentYear();

        $nextYear = Year::where('start', '=', $year->start + 1)
            ->where('end', '=', $year->end + 1)
            ->where('state', '=', -1)
            ->first();

        return $nextYear === null
            ? Year::create([
                'start' => $year->start + 1,
                'end' => $year->end + 1,
                'state' => -1,
            ])
            : $nextYear;
    }
}
