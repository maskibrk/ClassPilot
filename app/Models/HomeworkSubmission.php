<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HomeworkSubmission extends Model
{
    protected $fillable = [
        'homework_id',
        'student_id',
        'file_path',
        'submitted_at',
        'status',
        'feedback',
        'grade',
    ];
protected $casts = [
    'submitted_at' => 'datetime',
];
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function homework(): BelongsTo
    {
        return $this->belongsTo(Homework::class);
    }
}
