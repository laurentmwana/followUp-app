<?php

use App\Http\Controllers\Admin\Delibe\Annual\AdminAnnualController;
use App\Http\Controllers\Admin\Delibe\Annual\AdminNewAnnualBasicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Delibe\AdminNewDeliberationController;
use App\Http\Controllers\Admin\Delibe\AdminDelibeTargetController;
use App\Http\Controllers\Admin\Delibe\AdminDeliberationController;

Route::prefix('admin')->name('~')->middleware(['auth', 'verified', 'admin'])
    ->group(function () {

        Route::get('delibaration-semestrual', [AdminDeliberationController::class, 'index'])
            ->name('delibe.index');

        Route::get('delibaration-semestrual/{id}', [AdminDeliberationController::class, 'show'])
            ->name('delibe.show');

        Route::match([
            'PUT',
            'GET'
        ], 'delibaration-semestrual/{deliberation}/pv', [AdminDeliberationController::class, 'pv'])
            ->name('delibe.pv');

        Route::get('deliberaion-annual', [AdminAnnualController::class, 'index'])
            ->name('delibe.annual.index');

        Route::get('deliberaion-annual/{id}', [AdminAnnualController::class, 'show'])
            ->name('delibe.annual.show');

        Route::match([
            'PUT',
            'GET'
        ], 'deliberation-annual/{annual}/pv', [AdminAnnualController::class, 'pv'])
            ->name('delibe.annual.pv');

        Route::get('new-deliberation', AdminDelibeTargetController::class)
            ->name('delibe.new');

        Route::post('deliberation/create-basic', AdminNewDeliberationController::class)
            ->name('basic');

        Route::post('deliberation/create-basic-year', AdminNewAnnualBasicController::class)
            ->name('basic-year');

        Route::post('deliberation/create-classic', AdminNewDeliberationController::class)
            ->name('classic');

        Route::post('deliberation/create-classic-year', AdminNewDeliberationController::class)
            ->name('classic-year');
    });
