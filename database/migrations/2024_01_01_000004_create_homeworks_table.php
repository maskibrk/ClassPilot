<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lesson_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title');
            $table->text('instructions')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('status', ['assigned', 'submitted', 'reviewed', 'completed'])
                ->default('assigned');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['teacher_id', 'status']);
            $table->index(['student_id', 'due_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homeworks');
    }
};
