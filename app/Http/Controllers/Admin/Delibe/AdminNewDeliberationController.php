<?php

namespace App\Http\Controllers\Admin\Delibe;

use Illuminate\Http\Request;
use App\Events\DeliberationSemesterEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliberationSemesterRequest;
use Illuminate\Http\RedirectResponse;

class AdminNewDeliberationController extends Controller
{
    public function __invoke(
        DeliberationSemesterRequest $request
    ): RedirectResponse {

        event(new DeliberationSemesterEvent(
            $request->validated('programme'),
            $request->validated('semester'),
            $request->validated('option_id'),
        ));

        return redirect()->route('~delibe.index')
            ->with('success', "délibération effectuer avec succès.");
    }
}
