<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';

require __DIR__ . '/student.php';

require __DIR__ . '/admin.php';

require __DIR__ . '/delibe.php';

require __DIR__ . '/basic.php';
