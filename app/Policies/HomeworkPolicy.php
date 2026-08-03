<?php

namespace App\Policies;

use App\Models\Homework;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HomeworkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Homework $homework): bool
    {
        if ($user->isTeacher()) {
            return $user->id === $homework->academyClass->teacher_id;
        }
        if ($user->isStudent()) {
            return $homework->academyClass
                ->students()
                ->whereKey($user->student->id)
                ->exists();
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isTeacher();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Homework $homework): bool
    {

        return $user->isTeacher() && $user->id === $homework->academyClass->teacher_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Homework $homework): bool
    {
        return $this->update($user, $homework);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Homework $homework): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Homework $homework): bool
    {
        return false;
    }
}
