<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminNoteController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminGroupController;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminOptionController;
use App\Http\Controllers\Admin\AdminFacultyController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProfessorController;
use App\Http\Controllers\Admin\AdminProgrammeController;
use App\Http\Controllers\Admin\AdminDepartmentController;

Route::middleware(['auth', 'verified', 'admin'])
    ->group(function () {
        Route::get('dashboard', DashboardController::class)
            ->name('dashboard');
    });

Route::prefix('admin')->name('~')->middleware(['auth', 'verified', 'admin'])
    ->group(function () {

        Route::resource('faculty', AdminFacultyController::class)
            ->except(['create', 'store', 'destroy']);
        Route::resource('department', AdminDepartmentController::class)
            ->except(['create', 'store', 'destroy']);
        Route::resource('option', AdminOptionController::class)
            ->except(['destroy']);

        Route::get('level', [AdminLevelController::class, 'index'])->name('level.index');
        Route::get('level/{level}', [AdminLevelController::class, 'show'])->name('level.show');

        Route::resource('student', AdminStudentController::class);
        Route::resource('course', AdminCourseController::class);
        Route::resource('professor', AdminProfessorController::class);
        Route::resource('user', AdminUserController::class);

        Route::resource('group', AdminGroupController::class);

        Route::get('category', AdminCategoryController::class)
            ->name('category.index');

        Route::resource('note', AdminNoteController::class);

        Route::get('programme-lmd', AdminProgrammeController::class)
            ->name('lmd.index');
    });
