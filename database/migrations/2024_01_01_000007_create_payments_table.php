<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();

            $table->decimal('amount', 10, 2);
            $table->char('currency', 3)->default('USD');
            $table->date('period_month'); // billing period, stored as first-of-month

            $table->enum('status', ['paid', 'unpaid', 'partial', 'overdue'])
                ->default('unpaid');
            $table->date('due_date')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['teacher_id', 'status']);
            $table->index(['student_id', 'period_month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
