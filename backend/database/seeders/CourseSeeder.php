<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'category_id' => 1,
                'title' => 'React Fundamentals',
                'slug' => 'react-fundamentals',
                'description' => 'Learn the core concepts of React including components, state, props, hooks, and more. Perfect for beginners starting their React journey.',
                'price' => 0,
                'is_premium' => false,
                'difficulty' => 'beginner',
                'is_published' => true,
                'order' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'Advanced React Patterns',
                'slug' => 'advanced-react-patterns',
                'description' => 'Master advanced React patterns including compound components, render props, custom hooks, and performance optimization.',
                'price' => 199000,
                'is_premium' => true,
                'difficulty' => 'advanced',
                'is_published' => true,
                'order' => 2,
            ],
            [
                'category_id' => 2,
                'title' => 'Laravel for Beginners',
                'slug' => 'laravel-for-beginners',
                'description' => 'Get started with Laravel, the most popular PHP framework. Learn routing, controllers, Eloquent ORM, and building APIs.',
                'price' => 0,
                'is_premium' => false,
                'difficulty' => 'beginner',
                'is_published' => true,
                'order' => 1,
            ],
            [
                'category_id' => 2,
                'title' => 'Laravel API Mastery',
                'slug' => 'laravel-api-mastery',
                'description' => 'Build production-ready REST APIs with Laravel. Covers authentication, authorization, testing, and deployment.',
                'price' => 249000,
                'is_premium' => true,
                'difficulty' => 'intermediate',
                'is_published' => true,
                'order' => 2,
            ],
            [
                'category_id' => 3,
                'title' => 'Full Stack React + Laravel',
                'slug' => 'fullstack-react-laravel',
                'description' => 'Build a complete web application from scratch using React and Laravel. Covers authentication, payment integration, and deployment.',
                'price' => 349000,
                'is_premium' => true,
                'difficulty' => 'intermediate',
                'is_published' => true,
                'order' => 1,
            ],
            [
                'category_id' => 4,
                'title' => 'Git & GitHub Essentials',
                'slug' => 'git-github-essentials',
                'description' => 'Master version control with Git and collaboration with GitHub. Essential skills for every developer.',
                'price' => 0,
                'is_premium' => false,
                'difficulty' => 'beginner',
                'is_published' => true,
                'order' => 1,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
