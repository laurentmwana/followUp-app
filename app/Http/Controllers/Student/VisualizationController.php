<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class VisualizationController extends Controller
{

    /**
     * Permet à l'etudiant connecté de voir son parcours
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request): View
    {
        return view('student.vz.index', []);
    }
}
