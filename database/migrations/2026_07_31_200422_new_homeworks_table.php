<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('academy_class_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('instructions')->nullable();
            $table->date('due_date')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('academy_class_id');
            $table->index('due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
