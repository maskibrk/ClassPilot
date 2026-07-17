<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'teacher_id',
        'phone', 'timezone', 'avatar_path',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }
    public function isParent(): bool
    {
        return $this->role === 'parent';
    }


    // If this user IS a teacher: everything they own.
public function students(): BelongsToMany
{
    return $this->belongsToMany(
        Student::class,
        'student_teacher',
        'teacher_id',
        'student_id'
    );
}
    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'teacher_id');
    }

    // If this user IS a student account (role = student):
    // link back to their tutoring profile.
    public function studentProfile()
    {
        return $this->hasOne(Student::class, 'user_id');
    }
public function initials(): string
{
    return collect(explode(' ', $this->name))
        ->map(fn ($word) => strtoupper(substr($word, 0, 1)))
        ->take(2)
        ->implode('');
}

public function children(): HasMany
{
    return $this->hasMany(Student::class, 'parent_id');
}

//scopes
    public function scopeTeachers(Builder $query)
    {
        return $query->where('role', 'teacher');
    }


    public function scopeParents(Builder $query)
    {
        return $query->where('role', 'parent');
    }


    public function scopeStudents(Builder $query)
    {
        return $query->where('role', 'student');
    }


    public function scopeAdmins(Builder $query)
    {
        return $query->where('role', 'admin');
    }
}
