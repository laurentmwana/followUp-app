<?php

namespace App\Http\Controllers\Admin\Delibe;

use App\Models\Level;
use App\Models\Semester;
use App\Query\QueryYear;
use App\Models\Programme;
use App\Models\Deliberation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Events\ProgrammeBasicEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DelibeBasicController extends Controller
{


    public function __invoke(Request $request): RedirectResponse
    {
        $programmeId = $request->query('programme');
        $semesterId = $request->query('semester');

        event(new ProgrammeBasicEvent($programmeId, $semesterId));


        return redirect()->back()
            ->with('success', "délibération effectuer avec succès.");
    }
}
