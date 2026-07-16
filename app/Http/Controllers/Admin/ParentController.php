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
$parents=User::where('role','parent')->get();
return view("parents.index",compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

 $students=Student::whereNull("parent_id")->get();
return view('parents.create',compact('students'));
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
