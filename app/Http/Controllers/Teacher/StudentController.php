<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

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

            'password' => [
                'required',
                'confirmed',
                'min:8',
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


        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'student',
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'parent_id' => $validated['parent_id'] ?? null,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'status' => $validated['status'],
                'join_date' => $validated['join_date'] ?? null,
            ]);


            // attach logged-in teacher
            $student->teachers()->attach(auth()->id());
        });

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

        $student = $this->ownedStudent($student);

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
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        DB::transaction(function () use ($validated, $student) {

            $student->user()->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            $student->update(
                collect($validated)
                    ->except(['password'])
                    ->toArray()
            );

            if (!empty($validated('password'))) {
                $student->user()->update([
                    'password' => Hash::make($validated['password']),
                ]);
            }
        });
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
