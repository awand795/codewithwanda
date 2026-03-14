<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            // Add rich text content field (markdown)
            $table->longText('content_html')->nullable()->after('content');
            
            // Add code exercise fields
            $table->text('exercise_description')->nullable()->after('content_html');
            $table->text('starter_code')->nullable()->after('exercise_description');
            $table->text('solution_code')->nullable()->after('starter_code');
            $table->string('programming_language')->default('javascript')->after('solution_code');
            $table->json('test_cases')->nullable()->after('programming_language');
            
            // Add video fields
            $table->string('video_url')->nullable()->change();
            
            // Add completion tracking
            $table->boolean('is_completed')->default(false)->after('video_url');
            
            // Add indexes for better performance
            $table->index('programming_language');
            $table->index('is_completed');
        });
    }

    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropIndex(['programming_language']);
            $table->dropIndex(['is_completed']);
            $table->dropColumn([
                'content_html',
                'exercise_description',
                'starter_code',
                'solution_code',
                'programming_language',
                'test_cases',
                'is_completed',
            ]);
        });
    }
};
