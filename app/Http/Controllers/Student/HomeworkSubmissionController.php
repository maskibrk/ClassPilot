<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class HomeworkSubmissionController extends Controller
{
    public function index()
    {

        Gate::authorize('viewAny', HomeworkSubmission::class);
        $submissions = auth()->user()
            ->student
            ->submissions()
            ->with('homework.academyClass')
            ->latest()
            ->get();

        return view('student.submissions.index', compact('submissions'));
    }

    public function create(Homework $homework)
    {

        Gate::authorize('create', HomeworkSubmission::class);
  Gate::authorize('view', $homework);
        return view('student.submissions.create', compact('homework'));
    }

    public function store(Request $request, Homework $homework)
    {

        Gate::authorize('create', HomeworkSubmission::class);

        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg,zip',
                'max:10240',
            ],
        ]);

        $filePath = $request->file('file')->store('submissions');
$homework->submissions()->create(
    collect($validated)
        ->except('file')
        ->put('file_path', $filePath)
        ->put('student_id', auth()->user()->student->id)
        ->put('submitted_at', now())
        ->toArray()
);
        return redirect()
            ->route('student.homeworks.show', $homework)
            ->with('success', 'Homework submitted successfully.');
    }

    public function show(HomeworkSubmission $submission)
    {

        Gate::authorize('view', HomeworkSubmission::class);

        return view('student.submissions.show', compact('submission'));
    }

    public function edit(HomeworkSubmission $submission)
    {
        Gate::authorize('update', HomeworkSubmission::class);
  Gate::authorize('view', $submission->homework());
        return view('student.submissions.edit', compact('submission'));
    }

    public function update(Request $request, HomeworkSubmission $submission)
    {
        Gate::authorize('update', HomeworkSubmission::class);
  Gate::authorize('view',$submission->homework());
        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg,zip',
                'max:10240',
            ],
        ]);

        $filePath = $submission->file_path;

        if ($request->hasFile('file')) {

            if ($filePath) {
                Storage::delete($filePath);
            }

            $filePath = $request->file('file')->store('submissions');
        }

        $submission->update([
            'file_path' => $filePath,
            'submitted_at' => now(),
        ]);

        return redirect()
            ->route('student.submissions.show', $submission)
            ->with('success', 'Submission updated successfully.');
    }

    public function destroy(HomeworkSubmission $submission)
    {

        Gate::authorize('delete', HomeworkSubmission::class);

        if ($submission->file_path) {
            Storage::delete($submission->file_path);
        }

        $submission->delete();

        return redirect()
            ->route('student.submissions.index')
            ->with('success', 'Submission deleted.');
    }
public function preview(HomeworkSubmission $submission){

        Gate::authorize('view', $submission);

        abort_unless($submission->file_path, 404);

        return Storage::response($submission->file_path);
}

}
