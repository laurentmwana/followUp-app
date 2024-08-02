<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WelcomeController;

Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/about', [PageController::class, 'about'])->name('about');
