<?php

namespace App\Policies;

use App\Models\HomeworkSubmission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HomeworkSubmissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isTeacher() || $user->isStudent();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HomeworkSubmission $submission): bool
    {
if ($user->isTeacher()) {
return $user->id ===$submission->homework->AcademyClass->teacher_id;
}
if ($user->isStudent()) {
return $submission->student_id===$user->student->id;
}

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
return $user->isStudent();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HomeworkSubmission $submission): bool
    {
if ($user->isTeacher()) {
return $user->id ===$submission->homework->AcademyClass->teacher_id;
}
if ($user->isStudent()) {
return $submission->student_id===$user->student->id;
}
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HomeworkSubmission $submission): bool
    {
return $this->update($user, $submission);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HomeworkSubmission $homeworkSubmission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HomeworkSubmission $homeworkSubmission): bool
    {
        return false;
    }
}
