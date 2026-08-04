<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id', 'student_id', 'type', 'title', 'content', 'score',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
