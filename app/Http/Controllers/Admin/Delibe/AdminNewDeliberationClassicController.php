<?php

namespace App\Http\Controllers\Admin\Delibe;

use Illuminate\Http\Request;
use App\Events\DeliberationSemesterEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AdminNewDeliberationClassicController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $programmeId = $request->query('programme');
        $semesterId = $request->query('semester');

        event(new DeliberationSemesterEvent($programmeId, $semesterId));

        return redirect()->route('~delibe.index')
            ->with('success', "délibération effectuer avec succès.");
    }
}
