<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::teachers()->withCount('students')->get();
        return view("admin.teachers.index", compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("admin.teachers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
        ]);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }
    /**
     * Display the specified resource.
     */

    public function show(User $teacher)
    {

        $teacher->load('students', 'classes');

        return view('admin.teachers.show', compact('teacher'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $teacher)
    {
        $students = Student::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();


        $teacher->load('students:id,name');

        return view('admin.teachers.edit', compact('teacher', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $teacher)
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
                'unique:users,email,' . $teacher->id
            ],

            'phone' => [
                'nullable',
                'string'
            ],

            'students' => [
                'nullable',
                'array'
            ],

            'students.*' => [
                'exists:students,id'
            ],

        ]);

        $teacher->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        $teacher->students()->sync($validated['students'] ?? []);

        return redirect()
            ->route('admin.teachers.show', $teacher)
            ->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $teacher)
    {
        $teacher->students()->detach();

        $teacher->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}
