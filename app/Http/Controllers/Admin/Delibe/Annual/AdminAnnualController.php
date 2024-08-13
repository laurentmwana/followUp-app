<?php

namespace App\Http\Controllers\Admin\Delibe;

use App\Models\Annual;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
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

        return view('admin.delibe.annual', [
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

        return view('admin.delibe.show', [
            'annual' => $annual,
            'deliberateds' => $deliberateds,
        ]);
    }
}
