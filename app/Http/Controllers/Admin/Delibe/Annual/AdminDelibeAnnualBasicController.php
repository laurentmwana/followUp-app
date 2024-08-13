<?php

namespace App\Http\Controllers\Admin\Delibe\Annual;

use App\Events\ProgrammeBasicAnnualEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliberationAnnualRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminDelibeAnnualBasicController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        event(new ProgrammeBasicAnnualEvent(
            $request->query->get('programme')
        ));

        return redirect()->route('~delibe.index')
            ->with('success', "délibération annuelle L1 ~ L2 effectuer avec succès");
    }
}
