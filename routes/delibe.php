<?php

use App\Http\Controllers\Admin\Delibe\AdminAnnualController;
use App\Http\Controllers\Admin\Delibe\Annual\AdminNewAnnualBasicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Delibe\AdminNewDeliberationController;
use App\Http\Controllers\Admin\Delibe\AdminDelibeTargetController;
use App\Http\Controllers\Admin\Delibe\BasicVisualizationController;
use App\Http\Controllers\Admin\Delibe\AdminDeliberationController;

Route::prefix('admin')->name('~')->middleware(['auth', 'verified', 'admin'])
    ->group(function () {

        Route::get('deliberation', [AdminDeliberationController::class, 'index'])
            ->name('delibe.index');

        Route::get('deliberation/{id}', [AdminDeliberationController::class, 'show'])
            ->name('delibe.show');


        Route::get('deliberation/annual', [AdminAnnualController::class, 'index'])
            ->name('delibe.annual.index');

        Route::get('deliberation/annual/{id}', [AdminAnnualController::class, 'show'])
            ->name('delibe.annual.show');

        Route::get('new-deliberation', AdminDelibeTargetController::class)
            ->name('delibe.new');

        Route::post('deliberation/create-basic', AdminNewDeliberationController::class)
            ->name('basic');

        Route::post('deliberation/create-basic-year', AdminNewAnnualBasicController::class)
            ->name('basic-year');
    });
