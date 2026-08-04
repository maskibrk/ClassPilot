<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AcademyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Policies\AcademyClassPolicy;

class AcademicClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('viewAny', AcademyClass::class);
        $classes = auth()->user()->classes()->get();
        return view('teacher.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        Gate::authorize('create', AcademyClass::class);
        $students = auth()->user()->students()->orderBy('name')->get();

        return view('teacher.classes.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Gate::authorize('create', AcademyClass::class);
        $validated = $request->validate([
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

        $class = auth()->user()->classes()->create(
            collect($validated)
                ->except('students')
                ->toArray()
        );

        $class->students()->sync($validated['students'] ?? []);

        return redirect()
            ->route('teacher.classes.index')
            ->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademyClass $class)
    {

        Gate::authorize('view', $class);
        $class->load('students');

        return view('teacher.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademyClass $class)
    {
        Gate::authorize('view', $class);

        $students = auth()->user()->students()->orderBy('name')->get();

        return view('teacher.classes.edit', compact('class', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademyClass $class)
    {

        Gate::authorize('update', $class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'students' => ['nullable', 'array'],
            'students.*' => ['exists:students,id'],
        ]);

        $class->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        $class->students()->sync($validated['students'] ?? []);

        return redirect()
            ->route('teacher.classes.show', $class)
            ->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademyClass $class)
    {

        Gate::authorize('delete', $class);
        $class->delete();

        return redirect()
            ->route('teacher.classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}
