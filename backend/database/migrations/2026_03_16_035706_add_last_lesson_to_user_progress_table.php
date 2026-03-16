<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_progress', function (Blueprint $table) {
            // Add last accessed lesson tracking per course
            $table->foreignId('course_id')->nullable()->after('lesson_id')->constrained()->cascadeOnDelete();
            $table->timestamp('last_accessed_at')->nullable()->after('completed_at');
            
            // Add index for faster lookups
            $table->index(['user_id', 'course_id', 'last_accessed_at']);
        });
    }

    public function down(): void
    {
        Schema::table('user_progress', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'course_id', 'last_accessed_at']);
            $table->dropForeign(['course_id']);
            $table->dropColumn(['course_id', 'last_accessed_at']);
        });
    }
};
