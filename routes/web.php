<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
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

        Route::view('dashboard', 'admin.dashboard')->name('dashboard');

        Route::resource('students', AdminStudentController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::resource('teachers', TeacherController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::resource('parents', ParentController::class);
    });

Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::view('dashboard', 'teacher.dashboard')->name('dashboard');

        Route::resource('students', TeacherStudentController::class)
            ->only(['index', 'create', 'store', 'show']);
    });

require __DIR__ . '/settings.php';
