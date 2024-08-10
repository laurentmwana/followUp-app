<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Delibe\DelibeBasicController;
use App\Http\Controllers\Admin\Delibe\AdminChoiceTargetDelibeController;
use App\Http\Controllers\Admin\Delibe\BasicVisualizationController;

Route::prefix('admin')->name('~')->middleware(['auth', 'verified', 'admin'])
    ->group(function () {

        Route::get('deliberation-choice', AdminChoiceTargetDelibeController::class)
            ->name('delibe.index');

        Route::post('delibe-basic', DelibeBasicController::class)
            ->name('basic');

        Route::get('deliberation-basic', [BasicVisualizationController::class, 'index'])
            ->name('basic.index');
        Route::get('deliberation-basic/{id}', [BasicVisualizationController::class, 'show'])
            ->name('basic.show');
    });
