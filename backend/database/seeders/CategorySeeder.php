<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Frontend Development',
                'slug' => 'frontend-development',
                'description' => 'Learn modern frontend technologies including React, Vue, and more.',
                'icon' => 'monitor',
                'order' => 1,
            ],
            [
                'name' => 'Backend Development',
                'slug' => 'backend-development',
                'description' => 'Master server-side programming with Laravel, Node.js, and more.',
                'icon' => 'server',
                'order' => 2,
            ],
            [
                'name' => 'Full Stack',
                'slug' => 'full-stack',
                'description' => 'End-to-end web development from frontend to backend.',
                'icon' => 'layers',
                'order' => 3,
            ],
            [
                'name' => 'DevOps & Tools',
                'slug' => 'devops-tools',
                'description' => 'Deployment, CI/CD, Docker, and developer productivity tools.',
                'icon' => 'settings',
                'order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
