<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Semester;

class AdminSemesterController extends Controller
{
    /**
     * Permet d'afficher tous les semestres
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request): View
    {
        $id = $request->query->get('id');

        if (null !== $id && !empty($id)) {
            return view('admin.semester.show', [
                'semester' => Semester::findOrFail($id),
            ]);
        }

        return view('admin.semester.index', [
            'semester' => Semester::orderByDesc('updated_at')->get(),
        ]);
    }
}
