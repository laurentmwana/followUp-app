<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Helpers\SearchDefine;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\DepartmentRequest;

class AdminDepartmentController extends Controller
{

    /**
     * Permet d'afficher tous les départements
     * @param \App\Helpers\SearchDefine $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SearchDefine $search): View
    {
        return view('admin.department.index', [
            'departments' => $search->departments(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'un département
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.department.create', [
            'department' => new Department(),
        ]);
    }


    /**
     * Permet de créer un département
     *
     * @param \App\Http\Requests\Admin\DepartmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DepartmentRequest $request): RedirectResponse
    {
        Department::create($request->validated());

        return redirect()->route('~department.index')
            ->with('success', 'département créé');
    }


    /**
     * Permet d'afficher plus d'information sur un département
     * @param \App\Models\Department $department
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Department $department): View
    {
        return view('admin.department.show', [
            'department' => $department,
        ]);
    }



    /**
     *Permet d'afficher un formulaire d'edition d'un département
     * @param \App\Models\Department $department
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Department $department): View
    {
        return view('admin.department.edit', [
            'department' => $department,
        ]);
    }


    /**
     * Permet de modifier un département
     * @param \App\Http\Requests\Admin\DepartmentRequest $request
     * @param \App\Models\Department $department
     * @return RedirectResponse
     */
    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());

        return redirect()->route('~department.index')
            ->with('success', 'département modifiée');
    }


    /**
     * Permte de supprimer un département
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Department $department): RedirectResponse
    {
        $department->delete();

        return redirect()->route('~department.index')
            ->with('success', 'département supprimée');
    }
}
