<?php

namespace App\Http\Controllers\Admin\Delibe\Annual;

use App\Events\SecondLevelDeliberationAnnualEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliberationAnnualRequest;
use Illuminate\Http\RedirectResponse;

class AdminNewSecondLevelAnnualController extends Controller
{
    public function __invoke(
        DeliberationAnnualRequest $request
    ): RedirectResponse {

        event(new SecondLevelDeliberationAnnualEvent(
            $request->validated('programme'),
            $request->validated('option_id'),
        ));

        return redirect()->route('~delibe.annual.index')
            ->with('success', "délibération annuelle effectuer avec succès");
    }
}
