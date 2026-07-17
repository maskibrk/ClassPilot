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

return view("admin.parents.index",compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
$students = Student::select('id','name')
    ->whereNull('parent_id')
    ->orderBy('name')
    ->get();
return view('admin.parents.create',compact('students'));
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
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8'
            ],

            'students' => [
                'required',
                'array'
            ],

            'students.*' => [
                'exists:students,id'
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
                'parent_id' => $parent->id
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
    abort_unless($parent->isParent(), 404);

    $parent->load('children');

    return view('admin.parents.show', compact('parent'));
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
