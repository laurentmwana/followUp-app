<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SearchDefine;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\OptionRequest;

class AdminOptionController extends Controller
{

    /**
     * Permet d'afficher toutes les options
     * @param \App\Helpers\SearchDefine $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SearchDefine $search): View
    {
        return view('admin.option.index', [
            'options' => $search->options(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'une option
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.option.create', [
            'option' => new Option(),
        ]);
    }


    /**
     * Permet de créer une option
     *
     * @param \App\Http\Requests\Admin\OptionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OptionRequest $request): RedirectResponse
    {
        Option::create($request->validated());

        return redirect()->route('~option.index')
            ->with('success', 'option créée');
    }


    /**
     * Permet d'afficher plus d'information sur une option
     *
     * @param \App\Models\Option $option
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Option $option): View
    {
        return view('admin.option.show', [
            'option' => $option,
        ]);
    }



    /**
     *Permet d'afficher un formulaire d'edition d'une option
     * @param \App\Models\Option $option
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Option $option): View
    {
        return view('admin.option.edit', [
            'option' => $option,
        ]);
    }


    /**
     * Permet de modifier un option
     * @param \App\Http\Requests\Admin\OptionRequest $request
     * @param \App\Models\Option $option
     * @return RedirectResponse
     */
    public function update(OptionRequest $request, Option $option): RedirectResponse
    {
        $option->update($request->validated());

        return redirect()->route('~option.index')
            ->with('success', 'option modifiée');
    }


    /**
     * Permte de supprimer un option
     * @param \App\Models\Option $option
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Option $option): RedirectResponse
    {
        $option->delete();

        return redirect()->route('~option.index')
            ->with('success', 'option supprimée');
    }
}
