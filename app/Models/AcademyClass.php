<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademyClass extends Model
{
    protected $fillable = [
        'name',
        'description',
        'teacher_id',
        'capacity',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'academy_class_student'
        );
    }
    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }
public function isFull(): bool
{
    return $this->students_count >= $this->capacity;
}

public function enrollmentPercentage(): int
{
    if ($this->capacity <= 0) {
        return 0;
    }

    return min(
        100,
        (int) round(($this->students_count / $this->capacity) * 100)
    );
}
public function availableSeats(): int { return max(0, $this->capacity - $this->students_count); }
}
