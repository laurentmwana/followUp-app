<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\StudentRequest;
use App\Search\Search;

class AdminStudentController extends Controller
{

    /**
     * Permet d'afficher toutes les étudiants
     * @param \App\Search\Search $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Search $search): View
    {
        return view('admin.student.index', [
            'students' => $search->students(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'un étudiant
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.student.create', [
            'student' => new Student(),
        ]);
    }


    /**
     * Permet de créer un étudiant
     *
     * @param \App\Http\Requests\Admin\StudentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        Student::create($request->validated());

        return redirect()->route('~student.index')
            ->with('success', 'étudiant créé');
    }


    /**
     * Permet d'afficher plus d'information sur un étudiant
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Student $student): View
    {
        return view('admin.student.show', [
            'student' => $student,
        ]);
    }



    /**
     *Permet d'afficher un formulaire d'edition d'un étudiant
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Student $student): View
    {
        return view('admin.student.edit', [
            'student' => $student,
        ]);
    }


    /**
     * Permet de modifier un étudiant
     * @param \App\Http\Requests\Admin\StudentRequest $request
     * @param \App\Models\Student $student
     * @return RedirectResponse
     */
    public function update(StudentRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());

        return redirect()->route('~student.index')
            ->with('success', 'étudiant modifiée');
    }

    /**
     * Permte de supprimer un étudiant
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('~student.index')
            ->with('success', 'étudiant supprimé');
    }
}
