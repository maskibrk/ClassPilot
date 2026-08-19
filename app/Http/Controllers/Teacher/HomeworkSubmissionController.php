<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\HomeworkSubmissionController as AppHomeworkSubmissionController;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class HomeworkSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Homework $homework)
    {
        Gate::authorize('viewAny', $homework);
        $submissions = $homework->submissions()->get();
        return view('teacher.homeworks.submissions.index', compact('submissions', 'homework'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Homework $homework, HomeworkSubmission $submission)
    {

        Gate::authorize('view', $submission);
        return view('teacher.homeworks.submissions.show', compact('submission', 'homework'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Homework $homework, HomeworkSubmission $submission)
    {
        Gate::authorize('update', $submission);

        abort_unless(
            $submission->homework_id === $homework->id,
            404
        );
        return view(
            'teacher.homeworks.submissions.edit',
            compact('homework', 'submission')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Homework $homework, HomeworkSubmission $submission)
    {
        Gate::authorize('update', $submission);

        abort_unless(
            $submission->homework_id === $homework->id,
            404
        );

        $validated = $request->validate([
            'grade' => ['nullable', 'numeric', 'min:0', 'max:20'],
            'feedback' => ['nullable', 'string'],
        ]);

        $submission->update($validated);

        return redirect()
            ->route(
                'teacher.homeworks.submissions.show',
                [$homework, $submission]
            )
            ->with('success', 'Submission graded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function preview(HomeworkSubmission $submission)
    {

        Gate::authorize('view', $submission);

        abort_unless($submission->file_path, 404);

        return Storage::response($submission->file_path);
    }
}
