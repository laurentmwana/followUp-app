<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('basics.welcome');
    }
}
