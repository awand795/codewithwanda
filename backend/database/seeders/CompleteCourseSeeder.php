<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompleteCourseSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== ORIGINAL CATEGORIES ====================
        $frontendCat = Category::create([
            'name' => 'Frontend Development',
            'slug' => 'frontend-development',
            'description' => 'Learn modern frontend technologies including React, Vue, and more.',
            'icon' => 'monitor',
            'order' => 1,
        ]);

        $backendCat = Category::create([
            'name' => 'Backend Development',
            'slug' => 'backend-development',
            'description' => 'Master server-side programming with Laravel, Node.js, and more.',
            'icon' => 'server',
            'order' => 2,
        ]);

        $fullstackCat = Category::create([
            'name' => 'Full Stack',
            'slug' => 'full-stack',
            'description' => 'End-to-end web development from frontend to backend.',
            'icon' => 'layers',
            'order' => 3,
        ]);

        $devopsCat = Category::create([
            'name' => 'DevOps & Tools',
            'slug' => 'devops-tools',
            'description' => 'Deployment, CI/CD, Docker, and developer productivity tools.',
            'icon' => 'settings',
            'order' => 4,
        ]);

        // ==================== NEW CATEGORIES ====================
        $htmlCssCat = Category::create([
            'name' => 'HTML & CSS',
            'slug' => 'html-css',
            'description' => 'Master the foundations of web development with HTML and CSS',
            'icon' => 'file-code',
            'order' => 5,
        ]);

        $javascriptCat = Category::create([
            'name' => 'JavaScript',
            'slug' => 'javascript',
            'description' => 'Learn the programming language of the web',
            'icon' => 'code',
            'order' => 6,
        ]);

        $nodejsCat = Category::create([
            'name' => 'Node.js & Backend',
            'slug' => 'nodejs-backend',
            'description' => 'Build powerful backend applications with Node.js',
            'icon' => 'server',
            'order' => 7,
        ]);

        // ==================== ORIGINAL COURSES ====================
        
        // Course 1: React Fundamentals
        $reactCourse = Course::create([
            'category_id' => $frontendCat->id,
            'title' => 'React Fundamentals',
            'slug' => 'react-fundamentals',
            'description' => 'Learn the core concepts of React including components, state, props, hooks, and more. Perfect for beginners starting their React journey.',
            'thumbnail' => null,
            'price' => 0,
            'is_premium' => false,
            'difficulty' => 'beginner',
            'is_published' => true,
            'order' => 1,
        ]);
        $this->createReactFundamentals($reactCourse);

        // Course 2: Advanced React Patterns
        $advancedReactCourse = Course::create([
            'category_id' => $frontendCat->id,
            'title' => 'Advanced React Patterns',
            'slug' => 'advanced-react-patterns',
            'description' => 'Master advanced React patterns including compound components, render props, custom hooks, and performance optimization.',
            'thumbnail' => null,
            'price' => 199000,
            'is_premium' => true,
            'difficulty' => 'advanced',
            'is_published' => true,
            'order' => 2,
        ]);
        $this->createAdvancedReact($advancedReactCourse);

        // Course 3: Laravel for Beginners
        $laravelCourse = Course::create([
            'category_id' => $backendCat->id,
            'title' => 'Laravel for Beginners',
            'slug' => 'laravel-for-beginners',
            'description' => 'Get started with Laravel, the most popular PHP framework. Learn routing, controllers, Eloquent ORM, and building APIs.',
            'thumbnail' => null,
            'price' => 0,
            'is_premium' => false,
            'difficulty' => 'beginner',
            'is_published' => true,
            'order' => 1,
        ]);
        $this->createLaravelBeginners($laravelCourse);

        // Course 4: Laravel API Mastery
        $laravelApiCourse = Course::create([
            'category_id' => $backendCat->id,
            'title' => 'Laravel API Mastery',
            'slug' => 'laravel-api-mastery',
            'description' => 'Build production-ready REST APIs with Laravel. Covers authentication, authorization, testing, and deployment.',
            'thumbnail' => null,
            'price' => 249000,
            'is_premium' => true,
            'difficulty' => 'intermediate',
            'is_published' => true,
            'order' => 2,
        ]);
        $this->createLaravelAPI($laravelApiCourse);

        // Course 5: Full Stack React + Laravel
        $fullstackCourse = Course::create([
            'category_id' => $fullstackCat->id,
            'title' => 'Full Stack React + Laravel',
            'slug' => 'fullstack-react-laravel',
            'description' => 'Build a complete web application from scratch using React and Laravel. Covers authentication, payment integration, and deployment.',
            'thumbnail' => null,
            'price' => 349000,
            'is_premium' => true,
            'difficulty' => 'intermediate',
            'is_published' => true,
            'order' => 1,
        ]);
        $this->createFullStack($fullstackCourse);

        // Course 6: Git & GitHub Essentials
        $gitCourse = Course::create([
            'category_id' => $devopsCat->id,
            'title' => 'Git & GitHub Essentials',
            'slug' => 'git-github-essentials',
            'description' => 'Master version control with Git and collaboration with GitHub. Essential skills for every developer.',
            'thumbnail' => null,
            'price' => 0,
            'is_premium' => false,
            'difficulty' => 'beginner',
            'is_published' => true,
            'order' => 1,
        ]);
        $this->createGitGitHub($gitCourse);

        // ==================== NEW COURSES ====================
        
        // Course 7: HTML & CSS Fundamentals
        $htmlCssCourse = Course::create([
            'category_id' => $htmlCssCat->id,
            'title' => 'HTML & CSS Fundamentals - Zero to Hero',
            'slug' => 'html-css-fundamentals-zero-to-hero',
            'description' => 'Complete guide to mastering HTML5 and CSS3 from scratch. Learn to build beautiful, responsive websites with modern techniques including Flexbox, Grid, animations, and best practices used by professionals.',
            'thumbnail' => 'https://images.unsplash.com/photo-1621839673705-6617adf9e890?w=800',
            'price' => 0,
            'is_premium' => false,
            'difficulty' => 'beginner',
            'is_published' => true,
            'order' => 1,
        ]);
        $this->createHtmlCssCourse($htmlCssCourse);

        // Course 8: JavaScript Fundamentals
        $jsCourse = Course::create([
            'category_id' => $javascriptCat->id,
            'title' => 'JavaScript Fundamentals - Complete Guide',
            'slug' => 'javascript-fundamentals-complete-guide',
            'description' => 'Master JavaScript from the ground up. Learn variables, functions, objects, arrays, DOM manipulation, events, async programming, and modern ES6+ features.',
            'thumbnail' => 'https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=800',
            'price' => 0,
            'is_premium' => false,
            'difficulty' => 'beginner',
            'is_published' => true,
            'order' => 1,
        ]);
        $this->createJavaScriptCourse($jsCourse);

        // Course 9: Node.js & Express
        $nodejsCourse = Course::create([
            'category_id' => $nodejsCat->id,
            'title' => 'Node.js & Express - Backend Development Masterclass',
            'slug' => 'nodejs-express-backend-masterclass',
            'description' => 'Become a professional backend developer with Node.js and Express. Learn to build RESTful APIs, work with databases, implement authentication, and deploy production-ready applications.',
            'thumbnail' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800',
            'price' => 299000,
            'is_premium' => true,
            'difficulty' => 'intermediate',
            'is_published' => true,
            'order' => 1,
        ]);
        $this->createNodeJSCourse($nodejsCourse);
    }

    private function createReactFundamentals(Course $course): void
    {
        $modules = [
            ['title' => 'Getting Started with React', 'lessons' => [
                ['title' => 'Introduction to React', 'duration' => 15, 'free' => true],
                ['title' => 'Setting Up React Environment', 'duration' => 20, 'free' => true],
                ['title' => 'Your First React Component', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'React Components and Props', 'lessons' => [
                ['title' => 'Understanding Components', 'duration' => 20, 'free' => false],
                ['title' => 'Working with Props', 'duration' => 25, 'free' => false],
                ['title' => 'Component Composition', 'duration' => 20, 'free' => false],
            ]],
            ['title' => 'State and Events', 'lessons' => [
                ['title' => 'Introduction to State', 'duration' => 25, 'free' => false],
                ['title' => 'Handling Events', 'duration' => 20, 'free' => false],
                ['title' => 'State vs Props', 'duration' => 15, 'free' => false],
            ]],
        ];

        $this->createModulesAndLessons($course, $modules);
    }

    private function createAdvancedReact(Course $course): void
    {
        $modules = [
            ['title' => 'Advanced Hooks', 'lessons' => [
                ['title' => 'useMemo and useCallback', 'duration' => 30, 'free' => true],
                ['title' => 'Custom Hooks', 'duration' => 35, 'free' => false],
                ['title' => 'useReducer Deep Dive', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Performance Optimization', 'lessons' => [
                ['title' => 'React.memo', 'duration' => 20, 'free' => false],
                ['title' => 'Code Splitting', 'duration' => 25, 'free' => false],
                ['title' => 'Virtual DOM Optimization', 'duration' => 30, 'free' => false],
            ]],
        ];

        $this->createModulesAndLessons($course, $modules);
    }

    private function createLaravelBeginners(Course $course): void
    {
        $modules = [
            ['title' => 'Introduction to Laravel', 'lessons' => [
                ['title' => 'What is Laravel?', 'duration' => 15, 'free' => true],
                ['title' => 'Installing Laravel', 'duration' => 20, 'free' => true],
                ['title' => 'Laravel Directory Structure', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Routing and Controllers', 'lessons' => [
                ['title' => 'Basic Routing', 'duration' => 20, 'free' => false],
                ['title' => 'Route Parameters', 'duration' => 20, 'free' => false],
                ['title' => 'Creating Controllers', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Blade Templates', 'lessons' => [
                ['title' => 'Introduction to Blade', 'duration' => 20, 'free' => false],
                ['title' => 'Template Inheritance', 'duration' => 25, 'free' => false],
                ['title' => 'Blade Components', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Eloquent ORM', 'lessons' => [
                ['title' => 'Introduction to Eloquent', 'duration' => 25, 'free' => false],
                ['title' => 'Eloquent Relationships', 'duration' => 35, 'free' => false],
                ['title' => 'Eloquent Query Builder', 'duration' => 30, 'free' => false],
            ]],
        ];

        $this->createModulesAndLessons($course, $modules);
    }

    private function createLaravelAPI(Course $course): void
    {
        $modules = [
            ['title' => 'Building REST APIs', 'lessons' => [
                ['title' => 'REST API Concepts', 'duration' => 20, 'free' => true],
                ['title' => 'API Resources', 'duration' => 30, 'free' => false],
                ['title' => 'API Authentication with Sanctum', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'API Testing', 'lessons' => [
                ['title' => 'PHPUnit for APIs', 'duration' => 30, 'free' => false],
                ['title' => 'Testing Authentication', 'duration' => 25, 'free' => false],
                ['title' => 'API Documentation with Swagger', 'duration' => 30, 'free' => false],
            ]],
        ];

        $this->createModulesAndLessons($course, $modules);
    }

    private function createFullStack(Course $course): void
    {
        $modules = [
            ['title' => 'Project Setup', 'lessons' => [
                ['title' => 'Setting Up Laravel Backend', 'duration' => 25, 'free' => true],
                ['title' => 'Setting Up React Frontend', 'duration' => 25, 'free' => false],
                ['title' => 'Connecting Frontend to Backend', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Authentication System', 'lessons' => [
                ['title' => 'Laravel Sanctum Setup', 'duration' => 30, 'free' => false],
                ['title' => 'React Login Form', 'duration' => 35, 'free' => false],
                ['title' => 'Protected Routes', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Payment Integration', 'lessons' => [
                ['title' => 'Midtrans Setup', 'duration' => 25, 'free' => false],
                ['title' => 'Creating Payment Endpoint', 'duration' => 35, 'free' => false],
                ['title' => 'Handling Webhooks', 'duration' => 30, 'free' => false],
            ]],
        ];

        $this->createModulesAndLessons($course, $modules);
    }

    private function createGitGitHub(Course $course): void
    {
        $modules = [
            ['title' => 'Git Basics', 'lessons' => [
                ['title' => 'What is Version Control?', 'duration' => 10, 'free' => true],
                ['title' => 'Installing Git', 'duration' => 15, 'free' => true],
                ['title' => 'Your First Repository', 'duration' => 20, 'free' => false],
            ]],
            ['title' => 'GitHub Collaboration', 'lessons' => [
                ['title' => 'Creating a GitHub Account', 'duration' => 10, 'free' => false],
                ['title' => 'Pull Requests', 'duration' => 25, 'free' => false],
                ['title' => 'Code Review Process', 'duration' => 20, 'free' => false],
            ]],
        ];

        $this->createModulesAndLessons($course, $modules);
    }

    private function createHtmlCssCourse(Course $course): void
    {
        $modules = [
            ['title' => 'Introduction to Web Development', 'lessons' => [
                ['title' => 'How the Web Works', 'duration' => 15, 'free' => true],
                ['title' => 'Setting Up Development Environment', 'duration' => 20, 'free' => true],
                ['title' => 'Understanding URLs and Domains', 'duration' => 12, 'free' => false],
            ]],
            ['title' => 'HTML5 Basics', 'lessons' => [
                ['title' => 'HTML Document Structure', 'duration' => 18, 'free' => true],
                ['title' => 'Working with Text Elements', 'duration' => 25, 'free' => false],
                ['title' => 'Links, Images, and Media', 'duration' => 22, 'free' => false],
                ['title' => 'Lists, Tables, and Forms', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Semantic HTML5', 'lessons' => [
                ['title' => 'Semantic Elements Overview', 'duration' => 20, 'free' => false],
                ['title' => 'Building Semantic Page Structure', 'duration' => 25, 'free' => false],
                ['title' => 'Web Accessibility Fundamentals', 'duration' => 28, 'free' => false],
            ]],
            ['title' => 'CSS Fundamentals', 'lessons' => [
                ['title' => 'CSS Syntax and Selectors', 'duration' => 25, 'free' => true],
                ['title' => 'Colors, Backgrounds, and Borders', 'duration' => 22, 'free' => false],
                ['title' => 'The Box Model Explained', 'duration' => 30, 'free' => false],
                ['title' => 'Typography and Fonts', 'duration' => 20, 'free' => false],
            ]],
            ['title' => 'Modern Layouts with Flexbox', 'lessons' => [
                ['title' => 'Flexbox Fundamentals', 'duration' => 25, 'free' => false],
                ['title' => 'Flex Container Properties', 'duration' => 28, 'free' => false],
                ['title' => 'Flex Item Properties', 'duration' => 25, 'free' => false],
                ['title' => 'Building Navigation with Flexbox', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'CSS Grid Layout', 'lessons' => [
                ['title' => 'Grid Fundamentals', 'duration' => 28, 'free' => false],
                ['title' => 'Grid Template Areas', 'duration' => 25, 'free' => false],
                ['title' => 'Responsive Grid Layouts', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Responsive Web Design', 'lessons' => [
                ['title' => 'Media Queries', 'duration' => 25, 'free' => false],
                ['title' => 'Mobile-First Design', 'duration' => 22, 'free' => false],
                ['title' => 'Responsive Images and Videos', 'duration' => 20, 'free' => false],
            ]],
            ['title' => 'Advanced CSS Techniques', 'lessons' => [
                ['title' => 'CSS Transitions and Animations', 'duration' => 35, 'free' => false],
                ['title' => 'CSS Variables', 'duration' => 20, 'free' => false],
                ['title' => 'CSS Best Practices', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Final Project - Portfolio Website', 'lessons' => [
                ['title' => 'Project Setup and Planning', 'duration' => 20, 'free' => false],
                ['title' => 'Building Header and Hero Section', 'duration' => 40, 'free' => false],
                ['title' => 'Building Projects Gallery', 'duration' => 45, 'free' => false],
                ['title' => 'Contact Form and Footer', 'duration' => 35, 'free' => false],
                ['title' => 'Deployment and Final Touches', 'duration' => 25, 'free' => false],
            ]],
        ];

        $this->createModulesAndLessons($course, $modules);
    }

    private function createJavaScriptCourse(Course $course): void
    {
        $modules = [
            ['title' => 'JavaScript Basics', 'lessons' => [
                ['title' => 'Introduction to JavaScript', 'duration' => 15, 'free' => true],
                ['title' => 'Variables and Data Types', 'duration' => 25, 'free' => true],
                ['title' => 'Operators and Expressions', 'duration' => 20, 'free' => false],
            ]],
            ['title' => 'Control Flow', 'lessons' => [
                ['title' => 'Conditional Statements', 'duration' => 22, 'free' => false],
                ['title' => 'Switch Statements', 'duration' => 18, 'free' => false],
                ['title' => 'Loops: for, while, do-while', 'duration' => 28, 'free' => false],
            ]],
            ['title' => 'Functions', 'lessons' => [
                ['title' => 'Function Declarations', 'duration' => 25, 'free' => false],
                ['title' => 'Arrow Functions', 'duration' => 20, 'free' => false],
                ['title' => 'Scope and Closures', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Arrays and Objects', 'lessons' => [
                ['title' => 'Arrays and Array Methods', 'duration' => 35, 'free' => false],
                ['title' => 'Objects and Object Methods', 'duration' => 30, 'free' => false],
                ['title' => 'Destructuring and Spread', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'DOM Manipulation', 'lessons' => [
                ['title' => 'Introduction to the DOM', 'duration' => 20, 'free' => true],
                ['title' => 'Selecting and Manipulating Elements', 'duration' => 28, 'free' => false],
                ['title' => 'Event Handling', 'duration' => 32, 'free' => false],
                ['title' => 'Form Handling and Validation', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'Advanced JavaScript', 'lessons' => [
                ['title' => 'The "this" Keyword', 'duration' => 25, 'free' => false],
                ['title' => 'Prototypes and Classes', 'duration' => 35, 'free' => false],
                ['title' => 'Modules (Import/Export)', 'duration' => 22, 'free' => false],
            ]],
            ['title' => 'Asynchronous JavaScript', 'lessons' => [
                ['title' => 'Callbacks', 'duration' => 20, 'free' => false],
                ['title' => 'Promises', 'duration' => 30, 'free' => false],
                ['title' => 'Async/Await', 'duration' => 28, 'free' => false],
                ['title' => 'Fetch API', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'Final Project - Task Manager App', 'lessons' => [
                ['title' => 'Project Setup', 'duration' => 15, 'free' => false],
                ['title' => 'Building the UI', 'duration' => 40, 'free' => false],
                ['title' => 'Implementing CRUD Operations', 'duration' => 50, 'free' => false],
                ['title' => 'Local Storage Integration', 'duration' => 30, 'free' => false],
            ]],
        ];

        $this->createModulesAndLessons($course, $modules);
    }

    private function createNodeJSCourse(Course $course): void
    {
        $modules = [
            ['title' => 'Introduction to Node.js', 'lessons' => [
                ['title' => 'What is Node.js?', 'duration' => 15, 'free' => true],
                ['title' => 'Installing Node.js and NPM', 'duration' => 12, 'free' => true],
                ['title' => 'Node.js Module System', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Core Node.js Modules', 'lessons' => [
                ['title' => 'File System (fs) Module', 'duration' => 30, 'free' => false],
                ['title' => 'Path Module', 'duration' => 15, 'free' => false],
                ['title' => 'HTTP Module', 'duration' => 35, 'free' => false],
                ['title' => 'Events and Event Emitter', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Express.js Fundamentals', 'lessons' => [
                ['title' => 'Introduction to Express.js', 'duration' => 20, 'free' => true],
                ['title' => 'Setting Up Express Server', 'duration' => 25, 'free' => false],
                ['title' => 'Routing in Express', 'duration' => 30, 'free' => false],
                ['title' => 'Middleware Fundamentals', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'Building RESTful APIs', 'lessons' => [
                ['title' => 'REST API Principles', 'duration' => 25, 'free' => false],
                ['title' => 'Building CRUD Endpoints', 'duration' => 45, 'free' => false],
                ['title' => 'Request Validation', 'duration' => 30, 'free' => false],
                ['title' => 'Error Handling', 'duration' => 28, 'free' => false],
            ]],
            ['title' => 'Database Integration', 'lessons' => [
                ['title' => 'Introduction to MongoDB', 'duration' => 20, 'free' => false],
                ['title' => 'Mongoose ODM', 'duration' => 35, 'free' => false],
                ['title' => 'Data Modeling', 'duration' => 40, 'free' => false],
                ['title' => 'Database Queries', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'Authentication & Authorization', 'lessons' => [
                ['title' => 'Auth vs Authorization', 'duration' => 15, 'free' => false],
                ['title' => 'Password Hashing with bcrypt', 'duration' => 20, 'free' => false],
                ['title' => 'JWT Authentication', 'duration' => 40, 'free' => false],
                ['title' => 'Role-Based Access Control', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Advanced Topics', 'lessons' => [
                ['title' => 'File Uploads with Multer', 'duration' => 35, 'free' => false],
                ['title' => 'Email Sending with Nodemailer', 'duration' => 30, 'free' => false],
                ['title' => 'Pagination and Filtering', 'duration' => 35, 'free' => false],
                ['title' => 'Rate Limiting and Security', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Testing and Deployment', 'lessons' => [
                ['title' => 'Unit Testing with Jest', 'duration' => 40, 'free' => false],
                ['title' => 'API Testing with Supertest', 'duration' => 35, 'free' => false],
                ['title' => 'Environment Configuration', 'duration' => 20, 'free' => false],
                ['title' => 'Deploying to Production', 'duration' => 45, 'free' => false],
            ]],
            ['title' => 'Final Project - E-Commerce API', 'lessons' => [
                ['title' => 'Project Planning', 'duration' => 25, 'free' => false],
                ['title' => 'User Authentication', 'duration' => 50, 'free' => false],
                ['title' => 'Product Management', 'duration' => 45, 'free' => false],
                ['title' => 'Shopping Cart and Orders', 'duration' => 55, 'free' => false],
                ['title' => 'Payment Integration', 'duration' => 50, 'free' => false],
            ]],
        ];

        $this->createModulesAndLessons($course, $modules);
    }

    private function createModulesAndLessons(Course $course, array $modules): void
    {
        foreach ($modules as $moduleIndex => $moduleData) {
            $module = Module::create([
                'course_id' => $course->id,
                'title' => $moduleData['title'],
                'description' => 'Learn ' . Str::lower($moduleData['title']),
                'order' => $moduleIndex + 1,
            ]);

            foreach ($moduleData['lessons'] as $lessonIndex => $lessonData) {
                $slugPrefix = Str::slug($moduleData['title']) . '-';
                Lesson::create([
                    'module_id' => $module->id,
                    'title' => $lessonData['title'],
                    'slug' => $slugPrefix . Str::slug($lessonData['title']),
                    'content' => $this->getLessonContent($lessonData['title']),
                    'video_url' => null,
                    'duration_minutes' => $lessonData['duration'],
                    'is_free_preview' => $lessonData['free'],
                    'order' => $lessonIndex + 1,
                ]);
            }
        }
    }

    private function getLessonContent(string $title): string
    {
        return "# {$title}\n\n## Overview\n\nThis lesson covers {$title}.\n\n## Learning Objectives\n\n1. Understand the core concepts\n2. Apply in practical examples\n3. Build real-world projects\n\n## Content\n\nDetailed content for {$title}...\n\n## Summary\n\nKey takeaways from this lesson.";
    }
}
