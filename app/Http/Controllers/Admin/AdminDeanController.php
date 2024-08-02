<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SearchDefine;
use App\Models\Dean;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\DeanRequest;

class AdminDeanController extends Controller
{
    /**
     * Permet d'afficher toutes les doyens
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SearchDefine $search): View
    {
        return view('admin.dean.index', [
            'deans' => $search->deans(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'un doyen
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.dean.create', [
            'dean' => new Dean(),
        ]);
    }


    /**
     * Permet de créer doyen
     *
     * @param \App\Http\Requests\Admin\DeanRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DeanRequest $request): RedirectResponse
    {
        Dean::create($request->validated());

        return redirect()->route('~dean.index')
            ->with('success', 'coordinator ajouté');
    }


    /**
     * Permet d'afficher plus d'information sur un doyen
     *
     * @param \App\Models\Dean $dean
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Dean $dean): View
    {
        return view('admin.dean.show', [
            'dean' => $dean
        ]);
    }


    /**
     *Permet d'afficher un formulaire d'edition d'un doyen
     * @param \App\Models\Dean $dean
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Dean $dean): View
    {
        return view('admin.dean.edit', [
            'dean' => $dean
        ]);
    }

    /**
     * Permet de modifier doyen
     * @param \App\Http\Requests\Admin\DeanRequest $request
     * @param \App\Models\Dean $dean
     * @return RedirectResponse
     */
    public function update(DeanRequest $request, Dean $dean): RedirectResponse
    {
        $dean->update($request->validated());

        return redirect()->route('~dean.index')
            ->with('success', 'doyen modifié');
    }

    /**
     * Permte de supprimer doyen
     * @param \App\Models\Dean $dean
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Dean $dean): RedirectResponse
    {
        $dean->delete();

        return redirect()->route('~dean.index')
            ->with('success', 'doyen supprimé');
    }
}
