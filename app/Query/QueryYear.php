<?php


namespace App\Query;

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

    public static function newYear(): Year
    {
        $year = self::currentYear();

        $year->update(['state' => 1]);

        return Year::create([
            'start' => $year->end,
            'end' => $year->end + 1,
            'state' => 0,
        ]);
    }
}
