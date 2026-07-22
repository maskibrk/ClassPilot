<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = User::parents()
            ->withCount('children')
            ->get();

        return view("admin.parents.index", compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::select('id', 'name')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
        return view('admin.parents.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

            'students' => [
                'required',
                'array',
            ],

            'students.*' => [
                'exists:students,id',
            ],

        ]);


        // Create parent account

        $parent = User::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => Hash::make($validated['password']),

            'role' => 'parent',

        ]);


        // Attach multiple children

        Student::whereIn('id', $validated['students'])
            ->update([
                'parent_id' => $parent->id,
            ]);


        return redirect()
            ->route('admin.parents.index')
            ->with('success', 'Parent created with children successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $parent)
    {

        $parent->load('children');

        return view('admin.parents.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $parent)
    {

        Student::query()
            ->where(function ($query) use ($parent) {
                $query->whereNull('parent_id')->orWhere('parent_id', $parent->id);
            })
            ->orderBy('name')
            ->get(['id', 'name']);

        $parent->load('children:id,name');
        return view('admin.parents.edit', compact('parent', 'students'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $parent)
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
                'unique:users,email,' . $parent->id
            ],

            'phone' => [
                'nullable',
                'string'
            ],

            'children' => [
                'nullable',
                'array'
            ],

            'children.*' => [
                'exists:students,id'
            ],

        ]);

        $parent->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        // Remove current children
        $parent->children()->update([
            'parent_id' => null,
        ]);

        // Assign selected children
        if (!empty($validated['children'])) {

            Student::whereIn('id', $validated['children'])
                ->update([
                    'parent_id' => $parent->id
                ]);
        }

        return redirect()
            ->route('admin.parents.show', $parent)
            ->with('success', 'Parent updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $parent)
    {
        Student::where('parent_id', $parent->id)
            ->update([
                'parent_id' => null
            ]);
        $parent->delete();
        return redirect()
            ->route('admin.parents.index')
            ->with('success', 'Parent deleted successfully.');
    }
}
