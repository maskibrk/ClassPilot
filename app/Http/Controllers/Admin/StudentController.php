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
 $students=Student::all();

return view("students.index",compact('students'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    $teachers = User::where('role', 'teacher')->get();

    return view('students.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'teacher_id' => [
            'required',
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
        'parent_name' => [
            'nullable',
            'string'
        ],
        'parent_email' => [
            'nullable',
            'email'
        ],
        'parent_phone' => [
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

    Student::create($validated);

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
