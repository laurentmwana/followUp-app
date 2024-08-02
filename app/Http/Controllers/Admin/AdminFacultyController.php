<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SearchDefine;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\FacultyRequest;

class AdminFacultyController extends Controller
{


    /**
     * Permet d'afficher toutes les facultés
     * @param \Illuminate\Http\Request $request
     * @param \App\Helpers\SearchDefine $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request, SearchDefine $search): View
    {
        return view('admin.faculty.index', [
            'faculties' => $search->faculty(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'une faculté
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.faculty.create', [
            'faculty' => new Faculty(),
        ]);
    }


    /**
     * Permet de créer une faculté
     * @param \App\Http\Requests\Admin\FacultyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FacultyRequest $request): RedirectResponse
    {
        Faculty::create($request->validated());

        return redirect()->route('~faculty.index')
            ->with('success', 'faculté créée');
    }


    /**
     * Permet d'afficher plus d'information sur une faculté
     * @param \App\Models\Faculty $faculty
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Faculty $faculty): View
    {
        return view('admin.faculty.show', [
            'faculty' => $faculty,
        ]);
    }



    /**
     * Permet d'afficher un formulaire d'edittion d'une faculté
     * @param \App\Models\Faculty $faculty
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Faculty $faculty): View
    {
        return view('admin.faculty.edit', [
            'faculty' => $faculty,
        ]);
    }


    /**
     * Permet de modifier une faculté
     * @param \App\Http\Requests\Admin\FacultyRequest $request
     * @param \App\Models\Faculty $faculty
     * @return RedirectResponse
     */
    public function update(FacultyRequest $request, Faculty $faculty): RedirectResponse
    {
        $faculty->update($request->validated());

        return redirect()->route('~faculty.index')
            ->with('success', 'faculté modifiée');
    }


    /**
     * Permet de supprimer une faculté
     * @param \App\Models\Faculty $faculty
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Faculty $faculty): RedirectResponse
    {
        $faculty->delete();

        return redirect()->route('~faculty.index')
            ->with('success', 'faculté supprimée');
    }
}
