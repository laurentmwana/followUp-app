<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dean;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Helpers\SearchDefine;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\DeanRequest;
use App\Http\Requests\Admin\GroupRequest;

class AdminGroupController extends Controller
{

    /**
     * Permet d'afficher toutes les groupes
     * @param \App\Helpers\SearchDefine $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SearchDefine $search): View
    {
        return view('admin.group.index', [
            'groups' => $search->groups(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'un doyen
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.group.create', [
            'group' => new Group(),
        ]);
    }


    /**
     * Permet de créer doyen
     *
     * @param \App\Http\Requests\Admin\GroupRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GroupRequest $request): RedirectResponse
    {
        Group::create($request->validated());

        return redirect()->route('~group.index')
            ->with('success', 'groupe ajouté');
    }

    /**
     * Permet d'afficher plus d'information sur un doyen
     *
     * @param \App\Models\Group $group
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Group $group): View
    {
        return view('admin.group.show', [
            'group' => $group
        ]);
    }


    /**
     *Permet d'afficher un formulaire d'edition d'un groupe
     * @param \App\Models\Group $group
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Group $group): View
    {
        return view('admin.group.edit', [
            'group' => $group
        ]);
    }

    /**
     * Permet de modifier groupe
     * @param \App\Http\Requests\Admin\GroupRequest $request
     * @param \App\Models\Group $group
     * @return RedirectResponse
     */
    public function update(GroupRequest $request, Group $group): RedirectResponse
    {
        $group->update($request->validated());

        return redirect()->route('~group.index')
            ->with('success', 'groupe modifié');
    }

    /**
     * Permte de supprimer doyen
     * @param \App\Models\Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return redirect()->route('~group.index')
            ->with('success', 'groupe supprimé');
    }
}
