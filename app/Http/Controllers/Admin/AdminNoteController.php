<?php

namespace App\Http\Controllers\Admin;

use App\Constraint\NoteConstraint;
use App\Models\Dean;
use App\Models\Note;
use App\Search\Search;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\DeanRequest;
use App\Http\Requests\Admin\NoteRequest;
use App\Models\Course;

class AdminNoteController extends Controller
{
    public function __construct() {}

    public function index(Search $search): View
    {
        return view('admin.note.index', [
            'notes' => $search->notes(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'une note
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.note.create', [
            'note' => new Note(),
        ]);
    }


    /**
     * Permet de créer note
     *
     * @param \App\Http\Requests\Admin\NoteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NoteRequest $request): RedirectResponse
    {
        $course = Course::find($request->validated('course_id'));

        NoteConstraint::noCreateNoteForStudent(
            $request->validated(),
            $course
        );

        $note = $request->validated('note');
        $np = (float)$note * $course->credits;

        $course->notes()->create([
            'note' => $note,
            'np' => $np,
            'group_id' => $course->group_id,
            'semester_id' => $course->semester_id,
            'student_id' => $request->validated('student_id'),
            'year_id' => $request->validated('year_id'),
        ]);

        return redirect()->back()
            ->with('success', 'note ajouté');
    }


    /**
     * Permet d'afficher plus d'information sur une note
     *
     * @param \App\Models\Note $note
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Note $note): View
    {
        return view('admin.note.show', [
            'note' => $note
        ]);
    }

    /**
     *Permet d'afficher un formulaire d'edition d'une note
     * @param \App\Models\Note $note
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Note $note): View
    {
        return view('admin.note.edit', [
            'note' => $note
        ]);
    }

    /**
     * Permet de modifier note
     * @param \App\Http\Requests\Admin\NoteRequest $request
     * @param \App\Models\Note $note
     * @return RedirectResponse
     */
    public function update(NoteRequest $request, Note $note): RedirectResponse
    {
        $course = Course::find($request->validated('course_id'));

        NoteConstraint::hasNoteStudentExist($note);

        $n = $request->validated('note');
        $np = (float)$n * $course->credits;

        $note->update([
            'note' => $n,
            'np' => $np,
            'group_id' => $course->group_id,
            'semester_id' => $course->semester_id,
            'student_id' => $request->validated('student_id'),
            'year_id' => $request->validated('year_id'),
            'course_id' => $course->id,
        ]);

        return redirect()->route('~note.index')
            ->with('success', 'note modifiée');
    }

    /**
     * Permte de supprimer note
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Note $note): RedirectResponse
    {
        NoteConstraint::noDeleteNoteForStudent($note);

        $note->delete();

        return redirect()->route('~note.index')
            ->with('success', 'note supprimé');
    }
}
