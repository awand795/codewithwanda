<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComprehensiveCourseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Web Development Path Categories
        $htmlCssCategory = Category::create([
            'name' => 'HTML & CSS',
            'slug' => 'html-css',
            'description' => 'Master the foundations of web development with HTML and CSS',
            'icon' => 'file-code',
            'order' => 5,
        ]);

        $javascriptCategory = Category::create([
            'name' => 'JavaScript',
            'slug' => 'javascript',
            'description' => 'Learn the programming language of the web',
            'icon' => 'code',
            'order' => 6,
        ]);

        $nodejsCategory = Category::create([
            'name' => 'Node.js & Backend',
            'slug' => 'nodejs-backend',
            'description' => 'Build powerful backend applications with Node.js',
            'icon' => 'server',
            'order' => 7,
        ]);

        // ==================== HTML & CSS FUNDAMENTALS COURSE ====================
        $htmlCssCourse = Course::create([
            'category_id' => $htmlCssCategory->id,
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

        // ==================== JAVASCRIPT FUNDAMENTALS COURSE ====================
        $jsCourse = Course::create([
            'category_id' => $javascriptCategory->id,
            'title' => 'JavaScript Fundamentals - Complete Guide',
            'slug' => 'javascript-fundamentals-complete-guide',
            'description' => 'Master JavaScript from the ground up. Learn variables, functions, objects, arrays, DOM manipulation, events, async programming, and modern ES6+ features. Build interactive web applications with confidence.',
            'thumbnail' => 'https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=800',
            'price' => 0,
            'is_premium' => false,
            'difficulty' => 'beginner',
            'is_published' => true,
            'order' => 1,
        ]);

        $this->createJavaScriptCourse($jsCourse);

        // ==================== NODE.JS & EXPRESS COURSE ====================
        $nodejsCourse = Course::create([
            'category_id' => $nodejsCategory->id,
            'title' => 'Node.js & Express - Backend Development Masterclass',
            'slug' => 'nodejs-express-backend-masterclass',
            'description' => 'Become a professional backend developer with Node.js and Express. Learn to build RESTful APIs, work with databases, implement authentication, handle file uploads, and deploy production-ready applications.',
            'thumbnail' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800',
            'price' => 299000,
            'is_premium' => true,
            'difficulty' => 'intermediate',
            'is_published' => true,
            'order' => 1,
        ]);

        $this->createNodeJSCourse($nodejsCourse);
    }

    private function createHtmlCssCourse(Course $course): void
    {
        $modules = [
            ['title' => 'Introduction to Web Development', 'order' => 1, 'lessons' => [
                ['title' => 'How the Web Works', 'duration' => 15, 'free' => true],
                ['title' => 'Setting Up Your Development Environment', 'duration' => 20, 'free' => true],
                ['title' => 'Understanding URLs, Domains, and Hosting', 'duration' => 12, 'free' => false],
            ]],
            ['title' => 'HTML5 Basics', 'order' => 2, 'lessons' => [
                ['title' => 'HTML Document Structure', 'duration' => 18, 'free' => true],
                ['title' => 'Working with Text Elements', 'duration' => 25, 'free' => false],
                ['title' => 'Links, Images, and Media', 'duration' => 22, 'free' => false],
                ['title' => 'Lists, Tables, and Forms', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Semantic HTML5', 'order' => 3, 'lessons' => [
                ['title' => 'Semantic Elements Overview', 'duration' => 20, 'free' => false],
                ['title' => 'Building a Semantic Page Structure', 'duration' => 25, 'free' => false],
                ['title' => 'Web Accessibility Fundamentals', 'duration' => 28, 'free' => false],
            ]],
            ['title' => 'CSS Fundamentals', 'order' => 4, 'lessons' => [
                ['title' => 'CSS Syntax and Selectors', 'duration' => 25, 'free' => true],
                ['title' => 'Colors, Backgrounds, and Borders', 'duration' => 22, 'free' => false],
                ['title' => 'The Box Model Explained', 'duration' => 30, 'free' => false],
                ['title' => 'Typography and Fonts', 'duration' => 20, 'free' => false],
            ]],
            ['title' => 'Modern Layouts with Flexbox', 'order' => 5, 'lessons' => [
                ['title' => 'Flexbox Fundamentals', 'duration' => 25, 'free' => false],
                ['title' => 'Flex Container Properties', 'duration' => 28, 'free' => false],
                ['title' => 'Flex Item Properties', 'duration' => 25, 'free' => false],
                ['title' => 'Building a Navigation Bar with Flexbox', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'CSS Grid Layout', 'order' => 6, 'lessons' => [
                ['title' => 'Grid Fundamentals', 'duration' => 28, 'free' => false],
                ['title' => 'Grid Template Areas', 'duration' => 25, 'free' => false],
                ['title' => 'Responsive Grid Layouts', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Responsive Web Design', 'order' => 7, 'lessons' => [
                ['title' => 'Media Queries', 'duration' => 25, 'free' => false],
                ['title' => 'Mobile-First Design', 'duration' => 22, 'free' => false],
                ['title' => 'Responsive Images and Videos', 'duration' => 20, 'free' => false],
            ]],
            ['title' => 'Advanced CSS Techniques', 'order' => 8, 'lessons' => [
                ['title' => 'CSS Transitions and Animations', 'duration' => 35, 'free' => false],
                ['title' => 'CSS Variables (Custom Properties)', 'duration' => 20, 'free' => false],
                ['title' => 'CSS Best Practices and Organization', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Final Project - Portfolio Website', 'order' => 9, 'lessons' => [
                ['title' => 'Project Setup and Planning', 'duration' => 20, 'free' => false],
                ['title' => 'Building the Header and Hero Section', 'duration' => 40, 'free' => false],
                ['title' => 'Building the Projects Gallery', 'duration' => 45, 'free' => false],
                ['title' => 'Contact Form and Footer', 'duration' => 35, 'free' => false],
                ['title' => 'Deployment and Final Touches', 'duration' => 25, 'free' => false],
            ]],
        ];

        foreach ($modules as $moduleData) {
            $module = Module::create([
                'course_id' => $course->id,
                'title' => $moduleData['title'],
                'description' => 'Learn ' . Str::lower($moduleData['title']),
                'order' => $moduleData['order'],
            ]);

            foreach ($moduleData['lessons'] as $index => $lessonData) {
                $slugPrefix = Str::slug($moduleData['title']) . '-';
                Lesson::create([
                    'module_id' => $module->id,
                    'title' => $lessonData['title'],
                    'slug' => $slugPrefix . Str::slug($lessonData['title']),
                    'content' => $this->getLessonContent($lessonData['title']),
                    'video_url' => null,
                    'duration_minutes' => $lessonData['duration'],
                    'is_free_preview' => $lessonData['free'],
                    'order' => $index + 1,
                ]);
            }
        }
    }

    private function createJavaScriptCourse(Course $course): void
    {
        $modules = [
            ['title' => 'JavaScript Basics', 'order' => 1, 'lessons' => [
                ['title' => 'Introduction to JavaScript', 'duration' => 15, 'free' => true],
                ['title' => 'Variables and Data Types', 'duration' => 25, 'free' => true],
                ['title' => 'Operators and Expressions', 'duration' => 20, 'free' => false],
            ]],
            ['title' => 'Control Flow', 'order' => 2, 'lessons' => [
                ['title' => 'Conditional Statements', 'duration' => 22, 'free' => false],
                ['title' => 'Switch Statements', 'duration' => 18, 'free' => false],
                ['title' => 'Loops: for, while, do-while', 'duration' => 28, 'free' => false],
            ]],
            ['title' => 'Functions', 'order' => 3, 'lessons' => [
                ['title' => 'Function Declarations and Expressions', 'duration' => 25, 'free' => false],
                ['title' => 'Arrow Functions', 'duration' => 20, 'free' => false],
                ['title' => 'Scope and Closures', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Arrays and Objects', 'order' => 4, 'lessons' => [
                ['title' => 'Arrays and Array Methods', 'duration' => 35, 'free' => false],
                ['title' => 'Objects and Object Methods', 'duration' => 30, 'free' => false],
                ['title' => 'Destructuring and Spread Operator', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'DOM Manipulation', 'order' => 5, 'lessons' => [
                ['title' => 'Introduction to the DOM', 'duration' => 20, 'free' => true],
                ['title' => 'Selecting and Manipulating Elements', 'duration' => 28, 'free' => false],
                ['title' => 'Event Handling', 'duration' => 32, 'free' => false],
                ['title' => 'Form Handling and Validation', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'Advanced JavaScript', 'order' => 6, 'lessons' => [
                ['title' => 'The "this" Keyword', 'duration' => 25, 'free' => false],
                ['title' => 'Prototypes and Classes', 'duration' => 35, 'free' => false],
                ['title' => 'Modules (Import/Export)', 'duration' => 22, 'free' => false],
            ]],
            ['title' => 'Asynchronous JavaScript', 'order' => 7, 'lessons' => [
                ['title' => 'Callbacks and Callback Hell', 'duration' => 20, 'free' => false],
                ['title' => 'Promises', 'duration' => 30, 'free' => false],
                ['title' => 'Async/Await', 'duration' => 28, 'free' => false],
                ['title' => 'Fetch API and HTTP Requests', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'Final Project - Task Manager App', 'order' => 8, 'lessons' => [
                ['title' => 'Project Setup and Planning', 'duration' => 15, 'free' => false],
                ['title' => 'Building the UI', 'duration' => 40, 'free' => false],
                ['title' => 'Implementing CRUD Operations', 'duration' => 50, 'free' => false],
                ['title' => 'Local Storage Integration', 'duration' => 30, 'free' => false],
            ]],
        ];

        foreach ($modules as $moduleData) {
            $module = Module::create([
                'course_id' => $course->id,
                'title' => $moduleData['title'],
                'description' => 'Learn ' . Str::lower($moduleData['title']),
                'order' => $moduleData['order'],
            ]);

            foreach ($moduleData['lessons'] as $index => $lessonData) {
                Lesson::create([
                    'module_id' => $module->id,
                    'title' => $lessonData['title'],
                    'slug' => Str::slug($lessonData['title']),
                    'content' => $this->getLessonContent($lessonData['title']),
                    'video_url' => null,
                    'duration_minutes' => $lessonData['duration'],
                    'is_free_preview' => $lessonData['free'],
                    'order' => $index + 1,
                ]);
            }
        }
    }

    private function createNodeJSCourse(Course $course): void
    {
        $modules = [
            ['title' => 'Introduction to Node.js', 'order' => 1, 'lessons' => [
                ['title' => 'What is Node.js and Why Use It?', 'duration' => 15, 'free' => true],
                ['title' => 'Installing Node.js and NPM', 'duration' => 12, 'free' => true],
                ['title' => 'Node.js Module System', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Core Node.js Modules', 'order' => 2, 'lessons' => [
                ['title' => 'File System (fs) Module', 'duration' => 30, 'free' => false],
                ['title' => 'Path Module', 'duration' => 15, 'free' => false],
                ['title' => 'HTTP Module', 'duration' => 35, 'free' => false],
                ['title' => 'Events and Event Emitter', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Express.js Fundamentals', 'order' => 3, 'lessons' => [
                ['title' => 'Introduction to Express.js', 'duration' => 20, 'free' => true],
                ['title' => 'Setting Up Express Server', 'duration' => 25, 'free' => false],
                ['title' => 'Routing in Express', 'duration' => 30, 'free' => false],
                ['title' => 'Middleware Fundamentals', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'Building RESTful APIs', 'order' => 4, 'lessons' => [
                ['title' => 'REST API Principles', 'duration' => 25, 'free' => false],
                ['title' => 'Building CRUD Endpoints', 'duration' => 45, 'free' => false],
                ['title' => 'Request Validation', 'duration' => 30, 'free' => false],
                ['title' => 'Error Handling', 'duration' => 28, 'free' => false],
            ]],
            ['title' => 'Database Integration', 'order' => 5, 'lessons' => [
                ['title' => 'Introduction to MongoDB', 'duration' => 20, 'free' => false],
                ['title' => 'Mongoose ODM', 'duration' => 35, 'free' => false],
                ['title' => 'Data Modeling and Relationships', 'duration' => 40, 'free' => false],
                ['title' => 'Database Queries and Aggregations', 'duration' => 35, 'free' => false],
            ]],
            ['title' => 'Authentication & Authorization', 'order' => 6, 'lessons' => [
                ['title' => 'Authentication vs Authorization', 'duration' => 15, 'free' => false],
                ['title' => 'Password Hashing with bcrypt', 'duration' => 20, 'free' => false],
                ['title' => 'JWT Authentication', 'duration' => 40, 'free' => false],
                ['title' => 'Role-Based Access Control', 'duration' => 30, 'free' => false],
            ]],
            ['title' => 'Advanced Topics', 'order' => 7, 'lessons' => [
                ['title' => 'File Uploads with Multer', 'duration' => 35, 'free' => false],
                ['title' => 'Email Sending with Nodemailer', 'duration' => 30, 'free' => false],
                ['title' => 'Pagination, Sorting, and Filtering', 'duration' => 35, 'free' => false],
                ['title' => 'Rate Limiting and Security', 'duration' => 25, 'free' => false],
            ]],
            ['title' => 'Testing and Deployment', 'order' => 8, 'lessons' => [
                ['title' => 'Unit Testing with Jest', 'duration' => 40, 'free' => false],
                ['title' => 'API Testing with Supertest', 'duration' => 35, 'free' => false],
                ['title' => 'Environment Variables and Configuration', 'duration' => 20, 'free' => false],
                ['title' => 'Deploying to Production', 'duration' => 45, 'free' => false],
            ]],
            ['title' => 'Final Project - E-Commerce API', 'order' => 9, 'lessons' => [
                ['title' => 'Project Planning and Setup', 'duration' => 25, 'free' => false],
                ['title' => 'User Authentication System', 'duration' => 50, 'free' => false],
                ['title' => 'Product Management', 'duration' => 45, 'free' => false],
                ['title' => 'Shopping Cart and Orders', 'duration' => 55, 'free' => false],
                ['title' => 'Payment Integration (Midtrans)', 'duration' => 50, 'free' => false],
            ]],
        ];

        foreach ($modules as $moduleData) {
            $module = Module::create([
                'course_id' => $course->id,
                'title' => $moduleData['title'],
                'description' => 'Learn ' . Str::lower($moduleData['title']),
                'order' => $moduleData['order'],
            ]);

            foreach ($moduleData['lessons'] as $index => $lessonData) {
                Lesson::create([
                    'module_id' => $module->id,
                    'title' => $lessonData['title'],
                    'slug' => Str::slug($lessonData['title']),
                    'content' => $this->getLessonContent($lessonData['title']),
                    'video_url' => null,
                    'duration_minutes' => $lessonData['duration'],
                    'is_free_preview' => $lessonData['free'],
                    'order' => $index + 1,
                ]);
            }
        }
    }

    private function getLessonContent(string $title): string
    {
        $contents = [
            'How the Web Works' => "# How the Web Works\n\n## Introduction\n\nUnderstanding how the web works is fundamental to becoming a web developer.\n\n## The Client-Server Model\n\n### What is a Client?\n\nA **client** is any device or software that requests resources from a server.\n\n### What is a Server?\n\nA **server** is a computer that provides resources to clients.\n\n## HTTP and HTTPS\n\nHTTP is the protocol for web communication. HTTPS adds encryption for security.\n\n## Key Takeaways\n\n1. Web works on client-server model\n2. HTTP/HTTPS is the communication protocol\n3. DNS translates domains to IPs",
            
            'Setting Up Your Development Environment' => "# Setting Up Your Development Environment\n\n## Essential Tools\n\n### 1. Visual Studio Code\n- Free code editor\n- Extensions for web development\n\n### 2. Chrome Browser\n- Developer Tools\n- Fast performance\n\n### 3. Git\n- Version control\n- Collaboration\n\n## Installation Steps\n\n1. Download VS Code from code.visualstudio.com\n2. Install Chrome\n3. Install Git from git-scm.com",
            
            'HTML Document Structure' => "# HTML Document Structure\n\n## Basic Structure\n\n```html\n<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>Page Title</title>\n</head>\n<body>\n    Content here\n</body>\n</html>\n```\n\n## Key Elements\n\n- `<!DOCTYPE html>` - Document type\n- `<html>` - Root element\n- `<head>` - Metadata\n- `<body>` - Visible content",
            
            'Introduction to JavaScript' => "# Introduction to JavaScript\n\n## What is JavaScript?\n\nJavaScript is a programming language that adds interactivity to websites.\n\n## Where JavaScript Runs\n\n1. **Browsers** - Client-side\n2. **Node.js** - Server-side\n\n## Adding JavaScript\n\n```html\n<script src=\"script.js\"></script>\n```\n\n## Variables\n\n```javascript\nlet name = 'John';\nconst age = 25;\n```",
            
            'What is Node.js and Why Use It?' => "# What is Node.js?\n\nNode.js is a JavaScript runtime built on Chrome's V8 engine.\n\n## Why Node.js?\n\n1. **Fast** - Non-blocking I/O\n2. **JavaScript everywhere** - Same language frontend and backend\n3. **Large ecosystem** - NPM packages\n4. **Scalable** - Handles many connections\n\n## Use Cases\n\n- REST APIs\n- Real-time applications\n- Microservices",
            
            'Introduction to Express.js' => "# Introduction to Express.js\n\n## What is Express?\n\nExpress is a minimal Node.js web application framework.\n\n## Why Express?\n\n1. Simple routing\n2. Middleware support\n3. Template engines\n4. Easy to learn\n\n## Basic Server\n\n```javascript\nconst express = require('express');\nconst app = express();\n\napp.get('/', (req, res) => {\n    res.send('Hello World');\n});\n\napp.listen(3000);\n```",
        ];

        return $contents[$title] ?? "# {$title}\n\n## Overview\n\nThis lesson covers {$title}.\n\n## Learning Objectives\n\n1. Understand the core concepts\n2. Apply in practical examples\n3. Build real-world projects\n\n## Content\n\nDetailed content for {$title}...\n\n## Summary\n\nKey takeaways from this lesson.";
    }
}
