<?php

use App\Http\Controllers\Student\VisualizationController;
use Illuminate\Support\Facades\Route;



Route::prefix('student')->middleware(['auth', 'verified', 'student'])
    ->name('^')
    ->group(function () {
        Route::get('mon-parcours', VisualizationController::class)->name('vz.index');
        Route::get('reproduction-du-bulletin', VisualizationController::class)
            ->name('pdf.index');
    });
