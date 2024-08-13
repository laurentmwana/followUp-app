<?php

namespace App\Http\Controllers\Student;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class GeneratorController extends Controller
{

    /**
     * Permet à l'etudiant connecté de voir son parcours
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request): Response
    {
        $studentId = Auth::user()->student_id;

        // Chargez vos données
        $data = ['name' => 'John Doe'];

        // Générez le PDF avec une vue Blade
        $pdf = PDF::loadView('pdf.view', $data);

        // Optionnel: Ajoutez un fichier CSS externe
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isPhpEnabled', true);

        // Retourne le PDF comme réponse
        return $pdf->download('document.pdf');
    }
}
