<?php

namespace App\Http\Controllers\Admin\Delibe;

use App\Models\Deliberation;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class BasicVisualizationController extends Controller
{
    public function index(): View
    {
        $delibes = Deliberation::with(['year', 'level.programme', 'student', 'level.option'])
            ->whereSemesterId(1)
            ->get();

        return view('admin.delibe.vz.index', [
            'okStudent' => 12,
            'failStudent' => 125,
            'delibes' => $delibes,
        ]);
    }
    public function show(string $id): View
    {
        $delibe = Deliberation::with(['year', 'level.programme', 'student', 'level.option'])
            ->whereSemesterId(1)
            ->whereId($id)
            ->first();

        return view('admin.delibe.vz.show', [
            'delibe' => $delibe,
        ]);
    }
}
