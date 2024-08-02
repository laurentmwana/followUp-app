<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\SearchDefine;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\UserRequest;

class AdminUserController extends Controller
{
    /**
     * Permet d'afficher toutes les options
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SearchDefine $search): View
    {
        return view('admin.user.index', [
            'users' => $search->users(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'user
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.user.create', [
            'user' => new User(),
        ]);
    }

    /**
     * Permet de créer user
     *
     * @param \App\Http\Requests\Admin\UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        User::create([
            ...$request->validated(),
            'password' => Hash::make($request->validated('password')),
        ]);

        return redirect()->route('~user.index')
            ->with('success', 'user ajouté');
    }

    /**
     * Permet d'afficher plus d'information sur un user
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user): View
    {
        return view('admin.user.show', [
            'user' => $user
        ]);
    }

    /**
     *Permet d'afficher un formulaire d'edition d'user
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User  $user): View
    {
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Permet de modifier user
     * @param \App\Http\Requests\Admin\UserRequest $request
     * @param \App\Models\User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->fill([
            ...$request->validated(),
            'password' => Hash::make($request->validated('password')),
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();


        return redirect()->route('~user.index')
            ->with('success', 'user modifié');
    }

    /**
     * Permte de supprimer user
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('~user.index')
            ->with('success', 'user supprimé');
    }
}
