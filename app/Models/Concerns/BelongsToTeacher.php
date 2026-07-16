<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Applies real multi-tenant isolation: every query against a model using
 * this trait is automatically scoped to the current teacher, and new
 * records automatically get teacher_id filled in. This is what actually
 * enforces "teachers can never access another teacher's data" — the
 * teacher_id column alone does not.
 */
trait BelongsToTeacher
{
    public static function bootBelongsToTeacher(): void
    {
        static::addGlobalScope('teacher', function (Builder $builder) {
            if ($teacherId = self::currentTeacherId()) {
                $builder->where($builder->getModel()->getTable().'.teacher_id', $teacherId);
            }
        });

        static::creating(function ($model) {
            if (empty($model->teacher_id) && $teacherId = self::currentTeacherId()) {
                $model->teacher_id = $teacherId;
            }
        });
    }

    /**
     * Resolves the "tenant" for the currently authenticated user:
     * - a teacher/admin IS the tenant, so it's their own id
     * - a student/parent belongs to a teacher via users.teacher_id
     */
protected static function currentTeacherId(): ?int
{
    $user = Auth::user();

    if (! $user) {
        return null;
    }

    if ($user->role === 'admin') {
        return null;
    }

    return $user->role === 'teacher'
        ? $user->id
        : $user->teacher_id;
}

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'teacher_id');
    }
}
