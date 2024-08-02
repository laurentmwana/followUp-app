<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coordinator;
use Illuminate\Http\Request;
use App\Helpers\SearchDefine;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\CoordinatorRequest;

class AdminCoordinatorController extends Controller
{
    /**
     * Permet d'afficher toutes les options
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SearchDefine $search): View
    {
        return view('admin.coordinator.index', [
            'coordinators' => $search->coordinators(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'coordinator
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.coordinator.create', [
            'coordinator' => new Coordinator(),
        ]);
    }


    /**
     * Permet de créer coordinator
     *
     * @param \App\Http\Requests\Admin\CoordinatorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CoordinatorRequest $request): RedirectResponse
    {
        $coordinator = Coordinator::create([
            'name' => $request->validated('name'),
            'firstname' => $request->validated('firstname'),
            'phone' => $request->validated('phone'),
            'email' => $request->validated('email'),
            'sex' => $request->validated('sex'),
        ]);

        $coordinator->courses()->sync($request->validated('courses'));
        $coordinator->professors()->sync($request->validated('professors'));

        return redirect()->route('~coordinator.index')
            ->with('success', 'coordinator ajouté');
    }


    /**
     * Permet d'afficher plus d'information sur un coordinator
     *
     * @param \App\Models\Coordinator $coordinator
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Coordinator $coordinator): View
    {
        return view('admin.coordinator.show', [
            'coordinator' => $coordinator
        ]);
    }


    /**
     *Permet d'afficher un formulaire d'edition d'coordinator
     * @param \App\Models\Coordinator $coordinator
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Coordinator  $coordinator): View
    {
        return view('admin.coordinator.edit', [
            'coordinator' => $coordinator
        ]);
    }

    /**
     * Permet de modifier coordinator
     * @param \App\Http\Requests\Admin\CoordinatorRequest $request
     * @param \App\Models\Coordinator $coordinator
     * @return RedirectResponse
     */
    public function update(CoordinatorRequest $request, Coordinator  $coordinator): RedirectResponse
    {
        $coordinator->update([
            'name' => $request->validated('name'),
            'firstname' => $request->validated('firstname'),
            'phone' => $request->validated('phone'),
            'email' => $request->validated('email'),
            'sex' => $request->validated('sex'),
        ]);

        $coordinator->courses()->sync($request->validated('courses'));
        $coordinator->professors()->sync($request->validated('professors'));

        return redirect()->route('~coordinator.index')
            ->with('success', 'coordinator modifié');
    }

    /**
     * Permte de supprimer coordinator
     * @param \App\Models\Coordinator $coordinator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Coordinator  $coordinator): RedirectResponse
    {
        $coordinator->delete();

        return redirect()->route('~coordinator.index')
            ->with('success', 'coordinator supprimé');
    }
}
