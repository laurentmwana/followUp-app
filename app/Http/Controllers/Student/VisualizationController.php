<?php

namespace App\Http\Controllers\Student;

use App\Models\Year;
use App\Models\Group;
use App\Models\Level;
use App\Models\Student;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VisualizationController extends Controller
{

    /**
     * Permet à l'etudiant connecté de voir son parcours
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request): View
    {
        $studentId = Auth::user()->student_id;

        $student = Student::with([
            'levels.year', 'levels.programme',
            'levels.option',
            'levels.programme.semesters',
            'levels.programme.semesters.groups',
            'levels.programme.semesters.groups.category',
            'levels.programme.semesters.groups.notes.course',
            'levels.programme.semesters.groups.notes',
        ])
            ->find($studentId);

        $programmes = Programme::with(['semesters'])->get();

        $years = Year::orderByDesc('state')->simplePaginate();

        return view('student.vz.index', [
            'years' => $years,
            'programmes' => $programmes,
            'student' => $student,
        ]);
    }
}
