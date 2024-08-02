<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminNoteController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminYearController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminGroupController;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminOptionController;
use App\Http\Controllers\Admin\AdminFacultyController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminAssistantController;
use App\Http\Controllers\Admin\AdminProfessorController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminSemesterController;

Route::middleware(['auth', 'verified', 'admin'])
    ->group(function () {
        Route::get('dashboard', DashboardController::class)
            ->name('dashboard');
    });

Route::prefix('admin')->name('~')->middleware(['auth', 'verified', 'admin'])
    ->group(function () {

        Route::resource('faculty', AdminFacultyController::class);
        Route::resource('department', AdminDepartmentController::class);
        Route::resource('option', AdminOptionController::class);
        Route::resource('level', AdminLevelController::class);
        Route::resource('student', AdminStudentController::class);
        Route::resource('course', AdminCourseController::class);
        Route::resource('professor', AdminProfessorController::class);
        Route::resource('assistant', AdminAssistantController::class);
        Route::resource('user', AdminUserController::class);

        Route::resource('group', AdminGroupController::class);

        Route::get('category', AdminCategoryController::class)
            ->name('category.index');

        Route::resource('note', AdminNoteController::class);

        Route::get('deliberation', [AdminYearController::class, 'index'])
            ->name('delibe.index');

        Route::get('semester', AdminSemesterController::class)
            ->name('semester.index');
    });
