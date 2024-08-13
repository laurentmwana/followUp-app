<?php

namespace App\Http\Controllers\Student;

use App\Models\Year;
use App\Models\Student;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Query\QueryVisualization;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;


class VisualizationController extends Controller
{

    /**
     * Permet à l'etudiant connecté de voir son parcours
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request): View | Response
    {
        $studentId = Auth::user()->student_id;

        $student = QueryVisualization::findStudents(
            $request->query->get('programme'),
            $request->query->get('semester'),
            $studentId
        );

        $years = Year::orderByDesc('state')->simplePaginate();

        return view('student.vz.index', [
            'years' => $years,
            'student' => $student,
        ]);
    }
}
