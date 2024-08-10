<?php

namespace App\Listeners;

use App\Models\Level;
use App\Models\Semester;
use App\Query\QueryYear;
use App\Query\QueryDelibe;
use App\Events\ProgrammeBasicEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Response;

class ProgrammeBasicListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(ProgrammeBasicEvent $event): void
    {
        $year = QueryYear::currentYear();

        $level = QueryDelibe::findLevel($event->programmeId, $year->id);

        $has = $level->deliberations()
            ->whereSemesterId($event->semesterId)
            ->exists();

        if ($has) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $semester = QueryDelibe::findSemester($event->semesterId);

        foreach ($level->students as $student) {
            $credits = [];
            $tn = 0;
            $tnp = 0;
            $total = 0;
            $mca = [];
            $mcb = [];
            $meanGroup = [];

            foreach ($semester->groups as $group) {
                $credits[$group->name] = 0;
                foreach ($group->courses as $course) {
                    $credits[$group->name] += $course->credits;

                    foreach ($course->notes as $note) {
                        if ($note->student_id === $student->id) {
                            $meanGroup[$group->name][] = $note->note;
                            $tnp += ($note->note * $course->credits);
                        }
                    }
                }

                $meanGroup[$group->name] = ($group->courses->count() > 1)
                    ? floor(array_sum($meanGroup[$group->name]) / $credits[$group->name])
                    : array_shift($meanGroup[$group->name]);

                $group->category->name === 'A'
                    ? $mca[] = $meanGroup[$group->name]
                    : $mcb[] = $meanGroup[$group->name];

                $tn += $meanGroup[$group->name];
                $total += 20 * $credits[$group->name];
            };

            $meanA = count($mca) >= 1 ? floor(array_sum($mca) / count($mca)) : 0;
            $meanB = count($mcb) >= 1 ? floor(array_sum($mcb) / count($mcb)) : 0;
            $meanAB = floor(($meanA + $meanB)  / 2);

            $pourcent = floor(($tnp / $total) * 100);

            $student->deliberations()->create([
                'mca' => $meanA,
                'mcb' => $meanB,
                'mab' => $meanAB,
                'total' => $total,
                'tnp' => $tnp,
                'tn' => $tn,
                'pourcent' => $pourcent,
                'year_id' => $year->id,
                'semester_id' => $semester->id,
                'level_id' => $level->id,
            ]);
        }
    }
}
