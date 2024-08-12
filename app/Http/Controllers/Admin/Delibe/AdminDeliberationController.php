<?php

namespace App\Http\Controllers\Admin\Delibe;

use Illuminate\Http\Request;
use App\Events\ProgrammeBasicEvent;
use App\Http\Controllers\Controller;
use App\Models\Deliberation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminDeliberationController extends Controller
{
    public function index(): View
    {
        $deliberations = Deliberation::with([
            'deliberateds',
            'year',
            'semester',
            'level.programme',
            'level.option',
            'level.students',
        ])
            ->paginate();

        return view('admin.delibe.index', [
            'deliberations' => $deliberations,
        ]);
    }


    public function show(string $id): View
    {
        $deliberation = Deliberation::with([
            'deliberateds',
            'year',
            'semester',
            'level.programme',
            'level.option'
        ])
            ->whereId($id)
            ->first();

        if ($deliberation === null) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $deliberateds = $deliberation->deliberateds()->paginate();

        return view('admin.delibe.show', [
            'deliberation' => $deliberation,
            'deliberateds' => $deliberateds,
        ]);
    }
}
