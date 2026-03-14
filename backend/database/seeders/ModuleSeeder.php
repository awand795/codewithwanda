<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            // React Fundamentals (course_id: 1)
            ['course_id' => 1, 'title' => 'Getting Started with React', 'description' => 'Set up your development environment and create your first React app.', 'order' => 1],
            ['course_id' => 1, 'title' => 'Components & Props', 'description' => 'Learn how to create and compose React components.', 'order' => 2],
            ['course_id' => 1, 'title' => 'State & Hooks', 'description' => 'Master state management with React hooks.', 'order' => 3],

            // Advanced React (course_id: 2)
            ['course_id' => 2, 'title' => 'Advanced Hooks', 'description' => 'Deep dive into useReducer, useMemo, useCallback, and custom hooks.', 'order' => 1],
            ['course_id' => 2, 'title' => 'Design Patterns', 'description' => 'Implement compound components, render props, and HOCs.', 'order' => 2],

            // Laravel for Beginners (course_id: 3)
            ['course_id' => 3, 'title' => 'Laravel Setup & Basics', 'description' => 'Install Laravel and understand the project structure.', 'order' => 1],
            ['course_id' => 3, 'title' => 'Routing & Controllers', 'description' => 'Handle HTTP requests with routes and controllers.', 'order' => 2],
            ['course_id' => 3, 'title' => 'Eloquent ORM', 'description' => 'Work with databases using Laravel Eloquent.', 'order' => 3],

            // Laravel API Mastery (course_id: 4)
            ['course_id' => 4, 'title' => 'API Architecture', 'description' => 'Design RESTful APIs with best practices.', 'order' => 1],
            ['course_id' => 4, 'title' => 'Authentication & Authorization', 'description' => 'Secure your API with Sanctum and policies.', 'order' => 2],

            // Full Stack (course_id: 5)
            ['course_id' => 5, 'title' => 'Project Setup', 'description' => 'Set up the monorepo with React and Laravel.', 'order' => 1],
            ['course_id' => 5, 'title' => 'Building the API', 'description' => 'Create the backend API with Laravel.', 'order' => 2],
            ['course_id' => 5, 'title' => 'Building the Frontend', 'description' => 'Create the React frontend and connect to the API.', 'order' => 3],

            // Git & GitHub (course_id: 6)
            ['course_id' => 6, 'title' => 'Git Basics', 'description' => 'Learn the fundamentals of version control with Git.', 'order' => 1],
            ['course_id' => 6, 'title' => 'GitHub Collaboration', 'description' => 'Collaborate with others using GitHub.', 'order' => 2],
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}
