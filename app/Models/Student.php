<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'user_id',
        'name',
        'email',
        'phone',
        'notes',
        'status',
        'join_date',
    ];
    protected function casts(): array
    {
        return ['join_date' => 'date'];
    }

    // Optional login account for the student portal.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * @return BelongsToMany<Subject,Student,Pivot>
     */
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
    /**
     * @return HasMany<Lesson,Student>
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
    /**
     * @return HasMany<Homework,Student>
     */
    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }
    /**
     * @return HasMany<Payment,Student>
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    /**
     * @return HasMany<Note,Student>
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
    /**
     * @return HasMany<Attachment,Student>
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
    /**
     * @return BelongsTo<User,Student>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    /**
     * @return BelongsToMany<User,Student,Pivot>
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'student_teacher',
            'student_id',
            'teacher_id'
        );
    }
    /**
     * @return BelongsToMany<AcademyClass,Student,Pivot>
     */
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(
            AcademyClass::class,
            'academy_class_student'
        );
    }
    public function submissions()
    {
        return $this->hasMany(HomeworkSubmission::class, 'student_id');
    }
}
