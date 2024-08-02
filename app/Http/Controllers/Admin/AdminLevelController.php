<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Helpers\SearchDefine;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\LevelRequest;

class AdminLevelController extends Controller
{

    /**
     * Permet d'afficher toutes les promotions
     * @param \App\Helpers\SearchDefine $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SearchDefine $search): View
    {
        return view('admin.level.index', [
            'levels' => $search->levels(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'une promotion
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.level.create', [
            'level' => new Level(),
        ]);
    }


    /**
     * Permet de créer une promotion
     *
     * @param \App\Http\Requests\Admin\LevelRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LevelRequest $request): RedirectResponse
    {
        Level::create($request->validated());

        return redirect()->route('~level.index')
            ->with('success', 'promotion créée');
    }


    /**
     * Permet d'afficher plus d'information sur une promotion
     *
     * @param \App\Models\Level $level
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Level $level): View
    {
        return view('admin.level.show', [
            'level' => $level
        ]);
    }



    /**
     *Permet d'afficher un formulaire d'edition d'une promotion
     * @param \App\Models\Level $level
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Level $level): View
    {
        return view('admin.level.edit', [
            'level' => $level
        ]);
    }


    /**
     * Permet de modifier un option
     * @param \App\Http\Requests\Admin\LevelRequest $request
     * @param \App\Models\Level $level
     * @return RedirectResponse
     */
    public function update(LevelRequest $request, Level $level): RedirectResponse
    {
        $level->update($request->validated());

        return redirect()->route('~level.index')
            ->with('success', 'promotion modifiée');
    }


    /**
     * Permte de supprimer un option
     * @param \App\Models\Level $level
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Level $level): RedirectResponse
    {
        $level->delete();

        return redirect()->route('~level.index')
            ->with('success', 'promotion supprimée');
    }
}
