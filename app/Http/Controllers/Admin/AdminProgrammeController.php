<?php

namespace App\Http\Controllers\Admin;

use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class AdminProgrammeController extends Controller
{
    /**
     * Permet d'afficher les programmes LMD
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return view('admin.programme.index', [
            'programmes' => Programme::with(['semesters'])->get(),
        ]);
    }
}
