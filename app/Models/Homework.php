<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Homework extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'academy_class_id',
        'title',
        'instructions',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function academyClass(): BelongsTo
    {
        return $this->belongsTo(AcademyClass::class);
    }
}
