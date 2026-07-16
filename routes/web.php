<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ParentController;
use App\Models\Student;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('teachers', TeacherController::class)
            ->only(['index', 'create', 'store']);

        Route::resource('students', StudentController::class)
            ->only(['index', 'create', 'store']);

        Route::resource('parents', ParentController::class)
            ->only(['index', 'create', 'store']);

    });
require __DIR__.'/settings.php';
