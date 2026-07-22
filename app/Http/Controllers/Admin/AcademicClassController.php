<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademyClass;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class AcademicClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = AcademyClass::with('teacher')->withCount('students')->latest()->get();
        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::orderBy('name')->get();
        $teachers = User::teachers()->orderBy('name')->get();

        return view('admin.classes.create', compact('students', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'teacher_id' => [
                'required',
                Rule::userWithRole('teacher')
            ],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string',
                'max:255'
            ],

            'students' => [
                'nullable',
                'array'
            ],

            'students.*' => [
                'exists:students,id'
            ],
        ]);


        $class = AcademyClass::create(
            collect($validated)
                ->except('students')
                ->toArray()
        );

        $class->students()->sync($validated['students'] ?? []);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademyClass $class)
    {

        $class->load('teacher', 'students');

        return view('admin.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademyClass $class)
    {

        $class->load('teacher', 'students');

        $teachers = User::teachers()->orderBy('name')->get();

        $students = Student::orderBy('name')->get();

        return view('admin.classes.edit', compact('class', 'teachers', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademyClass $class)
    {

        $validated = $request->validate([

            'teacher_id' => [
                'required',
                Rule::userWithRole('teacher')
            ],

            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'students' => ['nullable', 'array'],
            'students.*' => ['exists:students,id'],
        ]);

        $class->update([
            collect($validated)
                ->except('students')
                ->toArray()
        ]);

        $class->students()->sync($validated['students'] ?? []);

        return redirect()
            ->route('admin.classes.show', $class)
            ->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademyClass $class)
    {

        $class->delete();

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}
