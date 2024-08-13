<?php

namespace App\Http\Controllers\Student;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Query\QueryVisualization;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OutInputPDFController extends Controller
{


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function __invoke(Request $request): View | Response
    {
        $studentId = Auth::user()->student_id;

        $student = QueryVisualization::findStudents(
            $request->query->get('programme'),
            $request->query->get('semester'),
            $studentId
        );


        if ($request->query->get('generate', false)) {

            // Générez le PDF avec une vue Blade
            $pdf = Pdf::loadView('student.outinput.index', [
                'student' => $student,
                'programme' => $request->query->get('programme', 1),
                'semester' => $request->query->get('semester'),
            ]);

            // Optionnel: Ajoutez un fichier CSS externe
            $pdf->setOption('isHtml5ParserEnabled', true);
            $pdf->setOption('isPhpEnabled', true);

            // Retourne le PDF comme réponse
            return $pdf->download('document.pdf');
        }



        return view('student.outinput.index', [
            'student' => $student,
        ]);
    }
}
