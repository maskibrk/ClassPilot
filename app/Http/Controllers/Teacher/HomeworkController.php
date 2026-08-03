<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Homework;
use App\Models\AcademyClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\put;

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
        Gate::authorize('create', Homework::class);

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
        $filePath = null;
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
            'file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg,zip',
                'max:10240',
            ],

            'due_date' => [
                'nullable',
                'date',
            ],
        ]);


        $class = AcademyClass::findOrFail($validated['academy_class_id']);

        Gate::authorize('update', $class);
        if ($request->hasFile('file')) {

            $filePath = $request
                ->file('file')
                ->store('homeworks');
        }

        $class->homeworks()->create(
            collect($validated)
                ->except('academy_class_id', 'file')
                ->put('file_path', $filePath)
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

        Gate::authorize('view', $homework);
        return view('teacher.homeworks.show', compact('homework'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Homework $homework)
    {

        Gate::authorize('update', $homework);
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
            'file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,png,jpg,jpeg,zip',
                'max:10240',
            ],
            'due_date' => [
                'nullable',
                'date',
            ],
        ]);

        // Ensure the selected class belongs to this teacher.

        $class = AcademyClass::findOrFail($validated['academy_class_id']);

        Gate::authorize('update', $class);

        $filePath = $homework->file_path;
        if ($request->hasFile('file')) {

            if ($filePath) {
                Storage::delete($filePath);
            }

            $filePath = $request->file('file')->store('homeworks');
        }


        $homework->update(
            collect($validated)
                ->except('file')
                ->put('file_path', $filePath)
                ->toArray()
        );

        return redirect()
            ->route('teacher.homeworks.show', $homework)
            ->with('success', 'Homework updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Homework $homework)
    {

        Gate::authorize('delete', $homework);
        $homework->delete();

        return redirect()
            ->route('teacher.homeworks.index')
            ->with('success', 'Homework deleted successfully.');
    }
    public function preview(Homework $homework)
    {
        Gate::authorize('view', $homework);
        abort_unless($homework->file_path, 404);

        return Storage::response($homework->file_path);
    }
}
