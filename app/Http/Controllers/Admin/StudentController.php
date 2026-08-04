<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('viewAny', Student::class);
        $students = Student::with(['teachers', 'parent'])->latest()->get();
        return view("admin.students.index", compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Student::class);
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

        Gate::authorize('create', Student::class);
        $validated = $request->validate([
            'teachers' => [
                'required',
                'array'
            ],

            'teachers.*' => [
                Rule::userWithRole('teacher')
            ],

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

        $student->teachers()->attach($validated['teachers']);



        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

        Gate::authorize('view', Student::class);
        $student->load([
            'teachers',
            'parent',
        ]);

        return view('admin.students.show', compact('student'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {

        Gate::authorize('update', Student::class);
        $teachers = User::teachers()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $parents = User::parents()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $student->load('teachers:id,name', 'parent:id,name');

        return view('admin.students.edit', compact('teachers', 'parents', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {

        Gate::authorize('update', Student::class);
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

            'password' => [
                'nullable',
                'confirmed',
                'min:8',
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

            'teachers' => [
                'required',
                'array'
            ],

            'teachers.*' => [

                Rule::userWithRole('teacher')
            ],

        ]);

        $student->user()->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $student->update(
            collect($validated)
                ->except(['teachers', 'password'])
                ->toArray()
        );

        if ($request->filled('password')) {
            $student->user()->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        $student->teachers()->sync($validated['teachers']);

        return redirect()
            ->route('admin.students.show', $student)
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {

        Gate::authorize('delete', Student::class);

        DB::transaction(function () use ($student) {
            $student->teachers()->detach();
            $user = $student->user;
            $student->delete();
            $user?->delete();
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
