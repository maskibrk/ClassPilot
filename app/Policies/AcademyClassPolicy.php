<?php

namespace App\Policies;

use App\Models\AcademyClass;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Policies\Concerns\AdminBypass;

class AcademyClassPolicy
{
    use AdminBypass;
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
    public function view(User $user, AcademyClass $class): bool
    {

        // Students
        if ($user->student) {
            return $class->students()
                ->whereKey($user->student->id)
                ->exists();
        }

        // Teachers
        if ($user->isTeacher()) {
            return $class->teacher_id === $user->id;
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
    public function update(User $user, AcademyClass $class): bool
    {

        return $user->isTeacher()
            && $class->teacher_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AcademyClass $class): bool
    {
        return $this->update($user, $class);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AcademyClass $academyClass): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AcademyClass $academyClass): bool
    {
        return false;
    }
}
