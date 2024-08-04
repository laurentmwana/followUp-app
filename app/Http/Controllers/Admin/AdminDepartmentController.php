<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Search\Search;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\DepartmentRequest;

class AdminDepartmentController extends Controller
{

    /**
     * Permet d'afficher tous les départements
     * @param \App\Search\Search $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Search $search): View
    {
        return view('admin.department.index', [
            'departments' => $search->departments(),
        ]);
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
}
