<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dean;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\DeanRequest;
use App\Http\Requests\Admin\NoteRequest;

class AdminNoteController extends Controller
{
    /**
     * Permet d'afficher toutes les notes
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
        $notes = Note::with(['student', 'course', 'semester'])
            ->orderByDesc('updated_at')
            ->paginate();

        return view('admin.note.index', [
            'notes' => $notes,
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
        Note::create($request->validated());

        return redirect()->route('~note.index')
            ->with('success', 'coordinator ajouté');
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
        $note->update($request->validated());

        return redirect()->route('~note.index')
            ->with('success', 'note modifié');
    }

    /**
     * Permte de supprimer note
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();

        return redirect()->route('~note.index')
            ->with('success', 'note supprimé');
    }
}
