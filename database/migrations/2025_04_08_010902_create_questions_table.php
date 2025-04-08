<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->boolean('is_multi_choice');
            $table->string('question_a')->nullable();
            $table->string('question_b')->nullable();
            $table->string('question_c')->nullable();
            $table->string('question_d')->nullable();
            $table->string('multi_choice_answer')->nullable();
            $table->text('free_question')->nullable();
            $table->foreignUuid('quiz_id')->constrained('quizzes');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
