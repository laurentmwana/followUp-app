<?php



namespace App\Math;

use App\Models\Course;
use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;

class MoyGroup
{
    public float $tn = 0;
    public int $credits = 0;
    public int $cp = 0;

    /**
     * @param \Illuminate\Database\Eloquent\Collection<int, Note> $notes
     */
    public function __construct(private Collection $notes) {}

    public function calcul(): self
    {
        $notes = [];
        $credits = 0;
        foreach ($this->notes as $note) {

            $course = $note->course;

            $notes[] = $note->note;
            $credits += $course->credits;
        }

        $tn = array_sum($notes);
        $cc = round($tn / count($notes));

        $this->credits = $credits;
        $this->tn = $tn;
        $this->cp = (int)($cc * $credits);

        return $this;
    }
}
