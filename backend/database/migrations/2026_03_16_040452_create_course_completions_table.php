<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->timestamp('completed_at')->useCurrent();
            $table->string('certificate_uuid')->unique();
            $table->string('certificate_hash')->unique();
            $table->integer('quiz_score')->nullable();
            $table->integer('total_lessons');
            $table->integer('completed_lessons');
            $table->timestamps();

            $table->unique(['user_id', 'course_id']);
            $table->index('certificate_uuid');
            $table->index('certificate_hash');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_completions');
    }
};
