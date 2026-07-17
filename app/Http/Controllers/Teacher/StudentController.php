<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
 $students=auth()->user()->students()->latest()->get();
return view("teacher.students.index",compact('students'));

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    $parents = User::parents()->get();

    return view('teacher.students.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'parent_id' => [
            'nullable',
            'exists:users,id'
        ],
        'name' => [
            'required',
            'string',
            'max:255'
        ],
        'email' => [
            'required',
            'email',
            'unique:students,email'
        ],
        'phone' => [
            'nullable',
            'string'
        ],
        'notes' => [
            'nullable',
            'string'
        ],
        'status' => [
            'required'
        ],
        'join_date' => [
            'nullable',
            'date'
        ],
    ]);


    $student = Student::create($validated);


    // attach logged-in teacher
    $student->teachers()->attach(auth()->id());


    return redirect()
        ->route('teacher.students.index')
        ->with('success', 'Student created successfully.');
}
    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
            $student->load([
        'teachers',
        'parent',
    ]);

    return view('teacher.students.show', compact('student'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
