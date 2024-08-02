<?php

namespace App\Http\Controllers\Admin;

use App\Models\Assistant;
use Illuminate\Http\Request;
use App\Helpers\SearchDefine;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\AssistantRequest;

class AdminAssistantController extends Controller
{


    public function index(SearchDefine $search): View
    {
        $assistants = Assistant::with(['courses', 'professors'])
            ->orderByDesc('updated_at')
            ->paginate();

        return view('admin.assistant.index', [
            'assistants' => $search->assistants(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'assistant
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.assistant.create', [
            'assistant' => new Assistant(),
        ]);
    }


    /**
     * Permet de créer assistant
     *
     * @param \App\Http\Requests\Admin\AssistantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AssistantRequest $request): RedirectResponse
    {
        $assistant = Assistant::create([
            'name' => $request->validated('name'),
            'firstname' => $request->validated('firstname'),
            'phone' => $request->validated('phone'),
            'email' => $request->validated('email'),
            'sex' => $request->validated('sex'),
        ]);

        $assistant->courses()->sync($request->validated('courses'));
        $assistant->professors()->sync($request->validated('professors'));

        return redirect()->route('~assistant.index')
            ->with('success', 'assistant ajouté');
    }


    /**
     * Permet d'afficher plus d'information sur un assistant
     *
     * @param \App\Models\Assistant $assistant
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Assistant $assistant): View
    {
        return view('admin.assistant.show', ['assistant' => $assistant]);
    }


    /**
     *Permet d'afficher un formulaire d'edition d'assistant
     * @param \App\Models\Assistant $assistant
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Assistant $assistant): View
    {
        return view('admin.assistant.edit', ['assistant' => $assistant]);
    }

    /**
     * Permet de modifier assistant
     * @param \App\Http\Requests\Admin\AssistantRequest $request
     * @param \App\Models\Assistant $assistant
     * @return RedirectResponse
     */
    public function update(AssistantRequest $request, Assistant $assistant): RedirectResponse
    {
        $assistant->update([
            'name' => $request->validated('name'),
            'firstname' => $request->validated('firstname'),
            'phone' => $request->validated('phone'),
            'email' => $request->validated('email'),
            'sex' => $request->validated('sex'),
        ]);

        $assistant->courses()->sync($request->validated('courses'));
        $assistant->professors()->sync($request->validated('professors'));

        return redirect()->route('~assistant.index')
            ->with('success', 'assistant modifié');
    }

    /**
     * Permte de supprimer assistant
     * @param \App\Models\Assistant $assistant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Assistant $assistant): RedirectResponse
    {
        $assistant->delete();

        return redirect()->route('~assistant.index')
            ->with('success', 'assistant supprimé');
    }
}
