<?php

namespace App\Http\Controllers\Admin\Delibe\Annual;

use App\Events\FirstLevelDeliberationAnnualEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliberationAnnualRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminNewFinalistLevelAnnualController extends Controller
{
    public function __invoke(
        DeliberationAnnualRequest $request
    ): RedirectResponse {
        event(new FirstLevelDeliberationAnnualEvent(
            $request->validated('programme'),
            $request->validated('option_id')
        ));

        return redirect()->route('~delibe.annual.index')
            ->with('success', "délibération annuelle L1 ~ L2 effectuer avec succès");
    }
}
