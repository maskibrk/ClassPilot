<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = auth()->user()->students()->latest()->get();
        return view("teacher.students.index", compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $parents = User::parents()->get();

        return view('teacher.students.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => [
                'nullable',
                Rule::userWithRole('parent')
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
        $student = $this->ownedStudent($student);

        $student->load('parent');

        return view('teacher.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {

        $student = $this->ownedStudent($student);

        $parents = User::parents()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return view('teacher.students.edit', compact('student', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'unique:students,email,' . $student->id
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
                'required',
                'in:active,inactive'
            ],

            'join_date' => [
                'nullable',
                'date'
            ],

            'parent_id' => [
                'nullable',
                Rule::userWithRole('parent')
            ],

        ]);

        $student->update($validated);


        return redirect()
            ->route('teacher.students.show', $student)
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student = $this->ownedStudent($student);
        $student->teachers()->detach(auth()->id());

        /* $student->delete(); */

        return redirect()
            ->route('teacher.students.index')
            ->with('success', 'Student deleted/detached for the moment successfully.');
    }
    //helper
    private function ownedStudent(Student $student): Student
    {

        return auth()->user()
            ->students()
            ->findOrFail($student->id);
    }
}
