<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use App\Models\Year;
use App\Models\Semester;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Note $note): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Note $note): bool
    {
        $year = Year::find($note->year_id);
        $semester = Semester::find($note->semester_id);

        return $year->state && $semester->deliberations->count() === 0;
    }
}
