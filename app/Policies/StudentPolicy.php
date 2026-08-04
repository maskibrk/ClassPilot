<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Policies\Concerns\AdminBypass;

class StudentPolicy
{
    use AdminBypass;


    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isTeacher();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Student $student): bool
    {
        if ($user->isTeacher()) {
            return $user->students()->whereKey($student->id)->exists();
        }
        if ($user->isParent()) {
            return $user->children()->whereKey($student->id)->exists();
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
    public function update(User $user, Student $student): bool
    {

        return $user->isTeacher() && $this->view($user, $student);;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Student $student): bool
    {

        return $this->update($user, $student);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Student $student): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Student $student): bool
    {
        return false;
    }
}
