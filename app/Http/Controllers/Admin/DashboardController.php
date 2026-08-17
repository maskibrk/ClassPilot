<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademyClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

public function index()
{
    $totalStudents = Student::count();

    $totalTeachers = User::teachers()->count();

    $totalParents = User::parents()->count();

    $totalCapacity = AcademyClass::sum('capacity');

    $totalEnrolled = Student::whereHas('classes')->count();

$classes = AcademyClass::withCount('students')->get();

$totalClasses = $classes->count();

$fullClasses = $classes
    ->filter(fn ($class) => $class->isFull())
    ->count();


    $newStudentsThisMonth = Student::whereMonth(
        'join_date',
        now()->month
    )
        ->whereYear(
            'join_date',
            now()->year
        )
        ->count();

    $studentsWithoutParent = Student::whereNull('parent_id')
        ->count();

    $studentsWithoutTeachers = Student::doesntHave('teachers')
        ->count();

    $recentStudents = Student::latest()
        ->take(5)
        ->get();

    return view('admin.dashboard', compact(
        'totalStudents',
        'totalTeachers',
        'totalParents',
        'totalClasses',
        'totalCapacity',
        'totalEnrolled',
        'fullClasses',
        'newStudentsThisMonth',
        'studentsWithoutParent',
        'studentsWithoutTeachers',
        'recentStudents',
    ));
}
}
