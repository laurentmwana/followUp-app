<?php

namespace App\Http\Controllers\Admin\Delibe;

use Illuminate\Http\Request;
use App\Events\DeliberationSemesterEvent;
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

        return view('admin.delibe.semester.index', [
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

        return view('admin.delibe.semester.show', [
            'deliberation' => $deliberation,
            'deliberateds' => $deliberateds,
        ]);
    }

    public function pv(Deliberation $deliberation, Request $request): View | RedirectResponse
    {
        if ($request->getMethod() === 'PUT') {

            $validated = $request->validate([
                'pv' => ['required', 'between:10,5000']
            ]);

            $deliberation->update($validated);

            return redirect()->route('~delibe.index')
                ->with(
                    'success',
                    "procès-verbal pour la délibération semestrielle mis à jour"
                );
        }

        return view('admin.delibe.semester.pv', [
            'deliberation' => $deliberation,
        ]);
    }
}
