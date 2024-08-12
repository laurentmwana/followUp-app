<?php

namespace App\Http\Controllers\Admin\Delibe;

use Illuminate\Http\Request;
use App\Events\ProgrammeBasicEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AdminNewDeliberationController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $programmeId = $request->query('programme');
        $semesterId = $request->query('semester');

        event(new ProgrammeBasicEvent($programmeId, $semesterId));

        return redirect()->route('~delibe.index')
            ->with('success', "délibération effectuer avec succès.");
    }
}
