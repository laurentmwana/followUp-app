<?php

namespace App\Http\Controllers\Student;

use App\Models\Year;
use App\Models\Student;
use App\Models\Programme;
use Illuminate\Http\Request;
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
    public function __invoke(Request $request): View
    {
        $studentId = Auth::user()->student_id;

        $checkStudentNote = function ($query) use ($studentId) {
            return $query->where('student_id', '=', $studentId);
        };

        $programmeId = $request->query->get('programme');
        $semesterId = $request->query->get('semester');
        $yearId = $request->query->get('year');

        $checkLevelSelect = function ($query) use ($programmeId) {
            if (null === $programmeId || empty($programmeId)) return $query;
            return $query->where('programme_id', '=', $programmeId);
        };

        $checkDelibe = function ($query) use ($semesterId, $studentId) {
            return (null === $semesterId || empty($semesterId))
                ? $query->where('student_id', '=', $studentId)
                : $query
                ->where('student_id', '=', $studentId)
                ->where('semester_id', '=', $semesterId);
        };

        $checkSemester = function ($query) use ($semesterId) {
            if (null === $semesterId || empty($semesterId)) return $query;
            return $query->whereIn('id', [$semesterId]);
        };



        $student = Student::with([
            'levels.year',
            'levels' => $checkLevelSelect,
            'levels.programme',
            'levels.option',
            'levels.programme.semesters' => $checkSemester,
            'levels.programme.semesters.deliberations' => $checkDelibe,
            'levels.programme.semesters.groups',
            'levels.programme.semesters.groups.category',
            'levels.programme.semesters.groups.notes.course',
            'levels.programme.semesters.groups.notes' => $checkStudentNote
        ])->find($studentId);

        $checkYear = function ($query) use ($studentId) {
            return $query->where('student_id', '=', $studentId);
        };

        $years = Year::orderByDesc('state')->simplePaginate();

        return view('student.vz.index', [
            'years' => $years,
            'student' => $student,
        ]);
    }
}
