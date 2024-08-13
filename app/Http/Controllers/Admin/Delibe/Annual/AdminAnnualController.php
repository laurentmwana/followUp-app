<?php

namespace App\Http\Controllers\Admin\Delibe\Annual;

use App\Models\Annual;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminAnnualController extends Controller
{
    public function index(): View
    {
        $annuals = Annual::with([
            'deliberateds',
            'year',
            'level.programme',
            'level.option',
            'level.students',
        ])
            ->paginate();

        return view('admin.delibe.annual.index', [
            'annuals' => $annuals,
        ]);
    }


    public function show(string $id): View
    {
        $annual = Annual::with([
            'deliberateds',
            'year',
            'level.programme',
            'level.option'
        ])
            ->whereId($id)
            ->first();

        if ($annual === null) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $deliberateds = $annual->deliberateds()->paginate();

        return view('admin.delibe.annual.show', [
            'annual' => $annual,
            'deliberateds' => $deliberateds,
        ]);
    }

    public function pv(Annual $annual, Request $request): View | RedirectResponse
    {
        if ($request->getMethod() === 'PUT') {

            $validated = $request->validate([
                'pv' => ['required', 'between:10,5000']
            ]);

            $annual->update($validated);

            return redirect()->route('~delibe.annual.index')
                ->with(
                    'success',
                    "procès-verbal pour la délibération annuelle mis à jour"
                );
        }

        return view('admin.delibe.annual.pv', [
            'annual' => $annual,
        ]);
    }
}
