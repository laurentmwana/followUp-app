<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dean;
use App\Models\Event;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Helpers\SearchDefine;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\EventRequest;

class AdminContactController extends Controller
{
    /**
     * Permet d'afficher toutes les évènements
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SearchDefine $search): View
    {
        return view('admin.contact.index', [
            'contacts' => $search->contacts(),
        ]);
    }


    /**
     * Permet d'afficher plus d'information sur un contact
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Contact $contact): View
    {
        return view('admin.contact.show', [
            'contact' => $contact
        ]);
    }

    /**
     * Permte de supprimer évènement
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('~contact.index')
            ->with('success', 'contact supprimé');
    }
}
