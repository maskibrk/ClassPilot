<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Teacher\AcademicClassController as TeacherAcademicClassController;
use App\Http\Controllers\Admin\AcademicClassController as AdminAcademicClassController;
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

        Route::resource('students', AdminStudentController::class);

        Route::resource('teachers', TeacherController::class);

        Route::resource('parents', ParentController::class);

        Route::resource('classes', AdminAcademicClassController::class);
    });

Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::view('dashboard', 'teacher.dashboard')->name('dashboard');

        Route::resource('students', TeacherStudentController::class);

        Route::resource('classes', TeacherAcademicClassController::class);
    });

Route::middleware(['auth', 'role:teacher'])
    ->prefix('parent')
    ->name('parent.')
    ->group(function () {

        Route::view('dashboard', 'parent.dashboard')->name('dashboard');
    });

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::view('dashboard', 'student.dashboard')->name('dashboard');
    });

require __DIR__ . '/settings.php';
