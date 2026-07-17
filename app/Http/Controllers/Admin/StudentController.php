<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
$students = Student::with(['teachers','parent'])->latest()->get();
return view("admin.students.index",compact('students'));

    }


    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    return view('admin.students.create', [
        'teachers' => User::teachers()->get(),
        'parents' => User::parents()->get(),
    ]);
}
    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'teachers' => [
            'required',
            'array'
        ],

        'teachers.*' => [
            'exists:users,id'
        ],

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


    $student = Student::create(
        collect($validated)
            ->except('teachers')
            ->toArray()
    );


    $student->teachers()
        ->attach($validated['teachers']);


    return redirect()
        ->route('admin.students.index')
        ->with('success', 'Student created successfully.');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
