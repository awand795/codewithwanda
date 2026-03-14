<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonPrerequisite;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = [
            // Module 1: Getting Started with React
            ['module_id' => 1, 'title' => 'What is React?', 'slug' => 'what-is-react', 'content' => $this->sampleContent('What is React?'), 'duration_minutes' => 10, 'is_free_preview' => true, 'order' => 1],
            ['module_id' => 1, 'title' => 'Setting Up Your Environment', 'slug' => 'setting-up-environment', 'content' => $this->sampleContent('Setting Up Your Environment'), 'duration_minutes' => 15, 'is_free_preview' => true, 'order' => 2],
            ['module_id' => 1, 'title' => 'Your First React App', 'slug' => 'first-react-app', 'content' => $this->sampleContent('Your First React App'), 'duration_minutes' => 20, 'is_free_preview' => false, 'order' => 3],

            // Module 2: Components & Props
            ['module_id' => 2, 'title' => 'Understanding Components', 'slug' => 'understanding-components', 'content' => $this->sampleContent('Understanding Components'), 'duration_minutes' => 15, 'is_free_preview' => false, 'order' => 1],
            ['module_id' => 2, 'title' => 'Props and Data Flow', 'slug' => 'props-data-flow', 'content' => $this->sampleContent('Props and Data Flow'), 'duration_minutes' => 20, 'is_free_preview' => false, 'order' => 2],
            ['module_id' => 2, 'title' => 'Component Composition', 'slug' => 'component-composition', 'content' => $this->sampleContent('Component Composition'), 'duration_minutes' => 25, 'is_free_preview' => false, 'order' => 3],

            // Module 3: State & Hooks
            ['module_id' => 3, 'title' => 'useState Hook', 'slug' => 'usestate-hook', 'content' => $this->sampleContent('useState Hook'), 'duration_minutes' => 20, 'is_free_preview' => false, 'order' => 1],
            ['module_id' => 3, 'title' => 'useEffect Hook', 'slug' => 'useeffect-hook', 'content' => $this->sampleContent('useEffect Hook'), 'duration_minutes' => 25, 'is_free_preview' => false, 'order' => 2],

            // Module 4: Advanced Hooks (Premium)
            ['module_id' => 4, 'title' => 'useReducer Deep Dive', 'slug' => 'usereducer-deep-dive', 'content' => $this->sampleContent('useReducer Deep Dive'), 'duration_minutes' => 30, 'is_free_preview' => true, 'order' => 1],
            ['module_id' => 4, 'title' => 'Custom Hooks', 'slug' => 'custom-hooks', 'content' => $this->sampleContent('Custom Hooks'), 'duration_minutes' => 35, 'is_free_preview' => false, 'order' => 2],

            // Module 5: Design Patterns (Premium)
            ['module_id' => 5, 'title' => 'Compound Components', 'slug' => 'compound-components', 'content' => $this->sampleContent('Compound Components'), 'duration_minutes' => 30, 'is_free_preview' => false, 'order' => 1],

            // Module 6: Laravel Setup & Basics
            ['module_id' => 6, 'title' => 'Installing Laravel', 'slug' => 'installing-laravel', 'content' => $this->sampleContent('Installing Laravel'), 'duration_minutes' => 10, 'is_free_preview' => true, 'order' => 1],
            ['module_id' => 6, 'title' => 'Project Structure', 'slug' => 'project-structure', 'content' => $this->sampleContent('Project Structure'), 'duration_minutes' => 15, 'is_free_preview' => true, 'order' => 2],

            // Module 7: Routing & Controllers
            ['module_id' => 7, 'title' => 'Basic Routing', 'slug' => 'basic-routing', 'content' => $this->sampleContent('Basic Routing'), 'duration_minutes' => 15, 'is_free_preview' => false, 'order' => 1],
            ['module_id' => 7, 'title' => 'Controllers', 'slug' => 'controllers', 'content' => $this->sampleContent('Controllers'), 'duration_minutes' => 20, 'is_free_preview' => false, 'order' => 2],

            // Module 8: Eloquent ORM
            ['module_id' => 8, 'title' => 'Models & Migrations', 'slug' => 'models-migrations', 'content' => $this->sampleContent('Models & Migrations'), 'duration_minutes' => 25, 'is_free_preview' => false, 'order' => 1],
            ['module_id' => 8, 'title' => 'Relationships', 'slug' => 'relationships', 'content' => $this->sampleContent('Relationships'), 'duration_minutes' => 30, 'is_free_preview' => false, 'order' => 2],

            // Module 9: API Architecture (Premium)
            ['module_id' => 9, 'title' => 'REST API Design', 'slug' => 'rest-api-design', 'content' => $this->sampleContent('REST API Design'), 'duration_minutes' => 20, 'is_free_preview' => true, 'order' => 1],
            ['module_id' => 9, 'title' => 'API Resources', 'slug' => 'api-resources', 'content' => $this->sampleContent('API Resources'), 'duration_minutes' => 25, 'is_free_preview' => false, 'order' => 2],

            // Module 10: Auth & Authorization (Premium)
            ['module_id' => 10, 'title' => 'Sanctum Authentication', 'slug' => 'sanctum-authentication', 'content' => $this->sampleContent('Sanctum Authentication'), 'duration_minutes' => 30, 'is_free_preview' => false, 'order' => 1],

            // Module 11-13: Full Stack (Premium)
            ['module_id' => 11, 'title' => 'Monorepo Setup', 'slug' => 'monorepo-setup', 'content' => $this->sampleContent('Monorepo Setup'), 'duration_minutes' => 20, 'is_free_preview' => true, 'order' => 1],
            ['module_id' => 12, 'title' => 'Building REST API', 'slug' => 'building-rest-api', 'content' => $this->sampleContent('Building REST API'), 'duration_minutes' => 40, 'is_free_preview' => false, 'order' => 1],
            ['module_id' => 13, 'title' => 'React Frontend Integration', 'slug' => 'react-frontend-integration', 'content' => $this->sampleContent('React Frontend Integration'), 'duration_minutes' => 45, 'is_free_preview' => false, 'order' => 1],

            // Module 14-15: Git & GitHub
            ['module_id' => 14, 'title' => 'Git Init & Commit', 'slug' => 'git-init-commit', 'content' => $this->sampleContent('Git Init & Commit'), 'duration_minutes' => 15, 'is_free_preview' => true, 'order' => 1],
            ['module_id' => 14, 'title' => 'Branching & Merging', 'slug' => 'branching-merging', 'content' => $this->sampleContent('Branching & Merging'), 'duration_minutes' => 20, 'is_free_preview' => false, 'order' => 2],
            ['module_id' => 15, 'title' => 'Pull Requests', 'slug' => 'pull-requests', 'content' => $this->sampleContent('Pull Requests'), 'duration_minutes' => 15, 'is_free_preview' => false, 'order' => 1],
        ];

        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }

        // Set up prerequisites
        // "Props and Data Flow" requires "Understanding Components"
        LessonPrerequisite::create(['lesson_id' => 5, 'prerequisite_lesson_id' => 4]);
        // "Component Composition" requires "Props and Data Flow"
        LessonPrerequisite::create(['lesson_id' => 6, 'prerequisite_lesson_id' => 5]);
        // "useEffect" requires "useState"
        LessonPrerequisite::create(['lesson_id' => 8, 'prerequisite_lesson_id' => 7]);
        // "Custom Hooks" requires "useReducer Deep Dive"
        LessonPrerequisite::create(['lesson_id' => 10, 'prerequisite_lesson_id' => 9]);
        // "Controllers" requires "Basic Routing"
        LessonPrerequisite::create(['lesson_id' => 15, 'prerequisite_lesson_id' => 14]);
        // "Relationships" requires "Models & Migrations"
        LessonPrerequisite::create(['lesson_id' => 17, 'prerequisite_lesson_id' => 16]);
        // "Branching & Merging" requires "Git Init & Commit"
        LessonPrerequisite::create(['lesson_id' => 25, 'prerequisite_lesson_id' => 24]);
    }

    private function sampleContent(string $title): string
    {
        return <<<HTML
<h1>{$title}</h1>
<p>Welcome to this lesson on <strong>{$title}</strong>. In this lesson, you'll learn the key concepts and practical skills needed to master this topic.</p>

<h2>Overview</h2>
<p>This lesson covers the fundamental concepts of {$title}. By the end, you'll have a solid understanding of how to apply these concepts in real-world projects.</p>

<h2>Key Concepts</h2>
<ul>
    <li>Understanding the basics of {$title}</li>
    <li>Practical examples and code demonstrations</li>
    <li>Best practices and common patterns</li>
    <li>Hands-on exercises to reinforce learning</li>
</ul>

<h2>Getting Started</h2>
<p>Let's dive into the core concepts. Make sure you have your development environment set up before proceeding.</p>

<pre><code>// Example code for {$title}
console.log("Let's learn {$title}!");
</code></pre>

<h2>Summary</h2>
<p>In this lesson, we covered the essential aspects of {$title}. Practice these concepts in your own projects to solidify your understanding.</p>
HTML;
    }
}
