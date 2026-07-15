<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();

            // Optional: file assigned/relevant to a specific student
            // (general library files have this null).
            $table->foreignId('student_id')->nullable()->constrained()->nullOnDelete();

            // Optional polymorphic link, e.g. a file attached to a
            // Homework (teacher-provided worksheet) or a HomeworkSubmission
            // (student-uploaded file).
            $table->nullableMorphs('attachable');

            $table->string('name');
            $table->string('path');
            $table->string('disk')->default('local'); // local now, s3 later
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable(); // bytes
            $table->enum('type', ['pdf', 'image', 'video', 'worksheet', 'other'])
                ->default('other');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['teacher_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
