<?php

namespace App\Http\Controllers\Admin\Delibe\Annual;

use App\Events\DeliberationAnnualEvent;
use App\Events\DeliberationClassicAnnualEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminNewAnnualClassicController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        event(new DeliberationClassicAnnualEvent(
            $request->query->get('programme')
        ));

        return redirect()->route('~delibe.annual.index')
            ->with('success', "délibération annuelle effectuer avec succès");
    }
}
