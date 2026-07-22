<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academy_class_student', function (Blueprint $table) {
            $table->foreignId('academy_class_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->primary(['academy_class_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academy_class_student');
    }
};
