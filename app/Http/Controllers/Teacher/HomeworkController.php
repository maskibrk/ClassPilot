<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Homework;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homeworks = Homework::whereHas('academyClass', function ($query) {
            $query->where('teacher_id', auth()->id());
        })
            ->with('academyClass')
            ->latest()
            ->get();
        return view('teacher.homeworks.index', compact('homeworks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = auth()->user()
            ->classes()
            ->orderBy('name')
            ->get();

        return view('teacher.homeworks.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'academy_class_id' => [
                'required',
                'exists:academy_classes,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'instructions' => [
                'nullable',
                'string',
            ],

            'due_date' => [
                'nullable',
                'date',
            ],
        ]);

        $class = auth()->user()
            ->classes()
            ->findOrFail($validated['academy_class_id']);

        $class->homeworks()->create(
            collect($validated)
                ->except('academy_class_id')
                ->toArray()
        );

        return redirect()
            ->route('teacher.homeworks.index')
            ->with('success', 'Homework created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Homework $homework)
    {

        $homework = Homework::where('id', $homework->id)->firstOrFail();
        return view('teacher.homeworks.show', compact('homework'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Homework $homework)
    {

        $homework = Homework::where('id', $homework->id)->firstOrFail();

        $classes = auth()->user()
            ->classes()
            ->orderBy('name')
            ->get();

        return view('teacher.homeworks.edit', compact('homework', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Homework $homework)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Homework $homework)
    {
        //
    }
}
