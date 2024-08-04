<?php

namespace App\Http\Controllers\Admin;

use App\Models\Professor;
use App\Search\Search;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\ProfessorRequest;

class AdminProfessorController extends Controller
{
    /**
     * Permet d'afficher toutes les professeurs
     * @param \App\Search\Search $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Search $search): View
    {
        return view('admin.professor.index', [
            'professors' => $search->professors(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'professeur
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.professor.create', [
            'professor' => new Professor(),
        ]);
    }


    /**
     * Permet de créer professeur
     *
     * @param \App\Http\Requests\Admin\ProfessorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProfessorRequest $request): RedirectResponse
    {
        Professor::create($request->validated());

        return redirect()->route('~professor.index')
            ->with('success', 'professeur ajouté');
    }


    /**
     * Permet d'afficher plus d'information sur un professeur
     *
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Professor $professor): View
    {
        return view('admin.professor.show', ['professor' => $professor]);
    }


    /**
     *Permet d'afficher un formulaire d'edition d'professeur
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Professor $professor): View
    {
        return view('admin.professor.edit', ['professor' => $professor]);
    }

    /**
     * Permet de modifier professeur
     * @param \App\Http\Requests\Admin\ProfessorRequest $request
     * @param \App\Models\Professor $professor
     * @return RedirectResponse
     */
    public function update(ProfessorRequest $request, Professor $professor): RedirectResponse
    {
        $professor->update($request->validated());


        return redirect()->route('~professor.index')
            ->with('success', 'professeur modifié');
    }

    /**
     * Permte de supprimer professeur
     * @param \App\Models\Professor $professor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Professor $professor): RedirectResponse
    {
        $professor->delete();

        return redirect()->route('~professor.index')
            ->with('success', 'professeur supprimé');
    }
}
