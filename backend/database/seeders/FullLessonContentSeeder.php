<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class FullLessonContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedHtmlCssLessons();
        $this->seedJavaScriptLessons();
        $this->seedNodeJsLessons();
        $this->seedReactLessons();
        $this->seedLaravelLessons();
    }

    private function seedHtmlCssLessons(): void
    {
        $lessons = [
            'introduction-to-web-development-how-the-web-works' => [
                'content_html' => $this->getHowWebWorksContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Buat file HTML sederhana dengan DOCTYPE, html, head, dan body. Tambahkan title dan heading.',
                'starter_code' => '<!-- Buat struktur HTML Anda di bawah ini -->\n\n',
                'solution_code' => '<!DOCTYPE html>\n<html lang="en">\n<head>\n    <meta charset="UTF-8">\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n    <title>Halaman Pertamaku</title>\n</head>\n<body>\n    <h1>Hello World!</h1>\n</body>\n</html>',
                'test_cases' => [],
            ],
            'introduction-to-web-development-setting-up-development-environment' => [
                'content_html' => $this->getDevEnvironmentContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Buat struktur folder project dengan index.html, folder css, js, dan images.',
                'starter_code' => '<!-- Buat struktur project Anda -->\n<!DOCTYPE html>\n<html>\n<head>\n    <title>Project Structure</title>\n</head>\n<body>\n    \n</body>\n</html>',
                'solution_code' => '<!DOCTYPE html>\n<html lang="en">\n<head>\n    <meta charset="UTF-8">\n    <title>My Project</title>\n    <link rel="stylesheet" href="css/style.css">\n</head>\n<body>\n    <h1>Project Structure</h1>\n    <script src="js/main.js"></script>\n</body>\n</html>',
                'test_cases' => [],
            ],
            'html5-basics-html-document-structure' => [
                'content_html' => $this->getHtmlStructureContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Buat dokumen HTML5 lengkap dengan semantic elements: header, nav, main, article, section, aside, footer.',
                'starter_code' => '<!-- Buat struktur HTML5 semantic -->\n<!DOCTYPE html>\n<html lang="en">\n\n</html>',
                'solution_code' => $this->getHtmlStructureSolution(),
                'test_cases' => [],
            ],
            'html5-basics-working-with-text-elements' => [
                'content_html' => $this->getTextElementsContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Buat artikel blog dengan heading, paragraph, bold, italic, list, dan blockquote.',
                'starter_code' => '<!-- Buat artikel blog -->\n<article>\n    \n</article>',
                'solution_code' => $this->getTextElementsSolution(),
                'test_cases' => [],
            ],
            'html5-basics-links-images-media' => [
                'content_html' => $this->getLinksImagesContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Buat halaman dengan navigation links, images, dan embedded video.',
                'starter_code' => '<!-- Buat halaman dengan links dan media -->\n<!DOCTYPE html>\n<html>\n<body>\n    \n</body>\n</html>',
                'solution_code' => $this->getLinksImagesSolution(),
                'test_cases' => [],
            ],
            'html5-basics-lists-tables-forms' => [
                'content_html' => $this->getListsTablesFormsContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Buat form registrasi dengan berbagai input types, validation, dan styling.',
                'starter_code' => '<!-- Buat form registrasi -->\n<form>\n    \n</form>',
                'solution_code' => $this->getListsTablesFormsSolution(),
                'test_cases' => [],
            ],
            'css-fundamentals-css-syntax-selectors' => [
                'content_html' => $this->getCssSyntaxContent(),
                'programming_language' => 'css',
                'exercise_description' => 'Buat stylesheet dengan berbagai selectors: element, class, id, attribute, pseudo-class.',
                'starter_code' => '/* Buat CSS dengan berbagai selectors */\n\n',
                'solution_code' => $this->getCssSyntaxSolution(),
                'test_cases' => [],
            ],
            'css-fundamentals-the-box-model-explained' => [
                'content_html' => $this->getBoxModelContent(),
                'programming_language' => 'css',
                'exercise_description' => 'Demonstrasikan box model dengan membuat card yang memiliki margin, border, padding, dan content.',
                'starter_code' => '<!-- HTML -->\n<div class="card">Content</div>\n\n/* CSS */\n.card {\n    \n}',
                'solution_code' => $this->getBoxModelSolution(),
                'test_cases' => [],
            ],
            'modern-layouts-with-flexbox-flexbox-fundamentals' => [
                'content_html' => $this->getFlexboxContent(),
                'programming_language' => 'css',
                'exercise_description' => 'Buat layout dengan Flexbox untuk navigation bar responsive.',
                'starter_code' => '<!-- Buat navigation bar dengan Flexbox -->\n<nav class="navbar">\n    <div class="logo">Logo</div>\n    <ul class="nav-links">\n        <li><a href="#">Home</a></li>\n        <li><a href="#">About</a></li>\n        <li><a href="#">Contact</a></li>\n    </ul>\n</nav>',
                'solution_code' => $this->getFlexboxSolution(),
                'test_cases' => [],
            ],
        ];

        $this->updateLessons($lessons);
    }

    private function seedJavaScriptLessons(): void
    {
        $lessons = [
            'intro-to-javascript' => [
                'content_html' => $this->getIntroToJSContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat program JavaScript yang mencetak "Hello, World!" dan melakukan operasi matematika sederhana.',
                'starter_code' => '// Tulis kode JavaScript Anda di sini\n\n',
                'solution_code' => '// Program JavaScript Pertama\nconsole.log("Hello, World!");\n\n// Operasi Matematika\nlet a = 10;\nlet b = 5;\n\nconsole.log("Penjumlahan:", a + b);\nconsole.log("Pengurangan:", a - b);\nconsole.log("Perkalian:", a * b);\nconsole.log("Pembagian:", a / b);\n\n// String Concatenation\nlet nama = "Developer";\nconsole.log("Hello, " + nama + "!");',
                'test_cases' => [
                    ['input' => '', 'expected_output' => 'Hello, World!'],
                ],
            ],
            'variables-data-types' => [
                'content_html' => $this->getVariablesContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Deklarasikan variabel dengan berbagai tipe data dan tampilkan hasilnya.',
                'starter_code' => '// Deklarasikan berbagai tipe data variabel\n\n',
                'solution_code' => $this->getVariablesSolution(),
                'test_cases' => [],
            ],
            'conditional-statements' => [
                'content_html' => $this->getConditionalsContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat program yang mengecek nilai dan memberikan grade berdasarkan kondisi.',
                'starter_code' => '// Buat program grading\nfunction getGrade(score) {\n    \n}\n\nconsole.log(getGrade(85));',
                'solution_code' => $this->getConditionalsSolution(),
                'test_cases' => [],
            ],
            'loops-for-while' => [
                'content_html' => $this->getLoopsContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat program yang mencetak angka 1-10 dan menghitung totalnya.',
                'starter_code' => '// Buat loop untuk mencetak angka 1-10\n\n',
                'solution_code' => $this->getLoopsSolution(),
                'test_cases' => [],
            ],
            'function-declarations' => [
                'content_html' => $this->getFunctionsContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat berbagai fungsi untuk operasi matematika.',
                'starter_code' => '// Buat fungsi-fungsi matematika\n\n',
                'solution_code' => $this->getFunctionsSolution(),
                'test_cases' => [],
            ],
            'arrays-array-methods' => [
                'content_html' => $this->getArraysContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Manipulasi array dengan berbagai method: map, filter, reduce, forEach.',
                'starter_code' => '// Manipulasi array\nconst numbers = [1, 2, 3, 4, 5];\n\n',
                'solution_code' => $this->getArraysSolution(),
                'test_cases' => [],
            ],
            'objects-object-methods' => [
                'content_html' => $this->getObjectsContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat object dan method untuk merepresentasikan data user.',
                'starter_code' => '// Buat object user dengan methods\n\n',
                'solution_code' => $this->getObjectsSolution(),
                'test_cases' => [],
            ],
            'intro-to-dom' => [
                'content_html' => $this->getDOMContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Manipulasi DOM untuk mengubah content dan style elemen.',
                'starter_code' => '// Manipulasi DOM\n// Note: Ini akan berjalan di browser\n\n',
                'solution_code' => $this->getDOMSolution(),
                'test_cases' => [],
            ],
            'event-handling' => [
                'content_html' => $this->getEventsContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat event handler untuk button click dan form submit.',
                'starter_code' => '// Buat event handlers\n\n',
                'solution_code' => $this->getEventsSolution(),
                'test_cases' => [],
            ],
            'promises' => [
                'content_html' => $this->getPromisesContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat Promise untuk simulasi fetch data dengan delay.',
                'starter_code' => '// Buat Promise untuk async operation\n\n',
                'solution_code' => $this->getPromisesSolution(),
                'test_cases' => [],
            ],
            'async-await' => [
                'content_html' => $this->getAsyncAwaitContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Konversi Promise-based code menjadi async/await.',
                'starter_code' => '// Buat async function dengan await\n\n',
                'solution_code' => $this->getAsyncAwaitSolution(),
                'test_cases' => [],
            ],
        ];

        $this->updateLessons($lessons);
    }

    private function seedNodeJsLessons(): void
    {
        $lessons = [
            'what-is-nodejs' => [
                'content_html' => $this->getWhatIsNodeJSContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat program Node.js sederhana yang menampilkan informasi environment.',
                'starter_code' => '// Tulis kode Node.js Anda\n\n',
                'solution_code' => '// Program Node.js Pertama\nconsole.log("Hello from Node.js!");\n\n// Informasi environment\nconsole.log("Node.js version:", process.version);\nconsole.log("Platform:", process.platform);\nconsole.log("Architecture:", process.arch);\nconsole.log("Current directory:", process.cwd());\nconsole.log("PID:", process.pid);',
                'test_cases' => [
                    ['input' => '', 'expected_output' => 'Hello from Node.js!'],
                ],
            ],
            'installing-nodejs-npm' => [
                'content_html' => $this->getInstallingNodeJSContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat package.json dan install dependencies.',
                'starter_code' => '// Command yang dijalankan di terminal:\n// npm init -y\n// npm install express\n\n',
                'solution_code' => '// package.json akan dibuat dengan:\n{\n  "name": "my-app",\n  "version": "1.0.0",\n  "main": "index.js",\n  "scripts": {\n    "start": "node index.js"\n  }\n}',
                'test_cases' => [],
            ],
            'fs-module' => [
                'content_html' => $this->getFSModuleContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat program untuk membaca dan menulis file menggunakan fs module.',
                'starter_code' => 'const fs = require("fs");\n\n// Baca dan tulis file\n\n',
                'solution_code' => $this->getFSModuleSolution(),
                'test_cases' => [],
            ],
            'http-module' => [
                'content_html' => $this->getHTTPModuleContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat HTTP server sederhana yang menampilkan "Hello World".',
                'starter_code' => 'const http = require("http");\n\n// Buat server\n\n',
                'solution_code' => $this->getHTTPModuleSolution(),
                'test_cases' => [],
            ],
            'intro-to-express' => [
                'content_html' => $this->getIntroToExpressContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat Express server dengan route dasar.',
                'starter_code' => 'const express = require("express");\nconst app = express();\n\n// Buat routes\n\n',
                'solution_code' => $this->getIntroToExpressSolution(),
                'test_cases' => [],
            ],
            'express-routing' => [
                'content_html' => $this->getExpressRoutingContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat berbagai routes dengan Express (GET, POST, PUT, DELETE).',
                'starter_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\n// Buat routes CRUD\n\n',
                'solution_code' => $this->getExpressRoutingSolution(),
                'test_cases' => [],
            ],
            'express-middleware' => [
                'content_html' => $this->getExpressMiddlewareContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat custom middleware untuk logging dan authentication.',
                'starter_code' => 'const express = require("express");\nconst app = express();\n\n// Buat middleware\n\n',
                'solution_code' => $this->getExpressMiddlewareSolution(),
                'test_cases' => [],
            ],
            'rest-api-principles' => [
                'content_html' => $this->getRESTPrinciplesContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat REST API endpoint untuk resource products.',
                'starter_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet products = [\n  { id: 1, name: "Product 1", price: 100 },\n  { id: 2, name: "Product 2", price: 200 }\n];\n\n// Buat REST endpoints\n\n',
                'solution_code' => $this->getRESTPrinciplesSolution(),
                'test_cases' => [],
            ],
            'crud-endpoints' => [
                'content_html' => $this->getCRUDEndpointsContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Implementasi lengkap CRUD operations untuk users.',
                'starter_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet users = [];\nlet nextId = 1;\n\n// Implementasi CRUD\n\n',
                'solution_code' => $this->getCRUDEndpointsSolution(),
                'test_cases' => [],
            ],
            'jwt-authentication' => [
                'content_html' => $this->getJWTAuthContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Implementasi JWT authentication untuk login dan protected routes.',
                'starter_code' => 'const jwt = require("jsonwebtoken");\nconst express = require("express");\nconst app = express();\napp.use(express.json());\n\nconst SECRET_KEY = "your-secret-key";\n\n// Implementasi JWT\n\n',
                'solution_code' => $this->getJWTAuthSolution(),
                'test_cases' => [],
            ],
        ];

        $this->updateLessons($lessons);
    }

    private function seedReactLessons(): void
    {
        $lessons = [
            'introduction-to-react' => [
                'content_html' => $this->getReactIntroContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat React component sederhana yang menampilkan greeting.',
                'starter_code' => '// Buat React component\nfunction Greeting() {\n    \n}\n\nexport default Greeting;',
                'solution_code' => $this->getReactIntroSolution(),
                'test_cases' => [],
            ],
            'setting-up-react-environment' => [
                'content_html' => $this->getReactSetupContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Setup project React dengan Vite dan buat component pertama.',
                'starter_code' => '// Command untuk setup:\n// npm create vite@latest my-app -- --template react\n// cd my-app\n// npm install\n// npm run dev\n\n',
                'solution_code' => '// Setelah setup, buat component App.jsx:\nfunction App() {\n  return (\n    <div>\n      <h1>Hello React!</h1>\n    </div>\n  );\n}\n\nexport default App;',
                'test_cases' => [],
            ],
            'understanding-components' => [
                'content_html' => $this->getReactComponentsContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat functional dan class components.',
                'starter_code' => '// Buat functional component\nfunction Welcome(props) {\n    \n}\n\n',
                'solution_code' => $this->getReactComponentsSolution(),
                'test_cases' => [],
            ],
            'working-with-props' => [
                'content_html' => $this->getReactPropsContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat component yang menerima dan menggunakan props.',
                'starter_code' => '// Buat component dengan props\nfunction UserProfile(props) {\n    \n}\n\n',
                'solution_code' => $this->getReactPropsSolution(),
                'test_cases' => [],
            ],
            'introduction-to-state' => [
                'content_html' => $this->getReactStateContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat component dengan useState hook untuk counter.',
                'starter_code' => 'import { useState } from "react";\n\nfunction Counter() {\n    \n}\n\n',
                'solution_code' => $this->getReactStateSolution(),
                'test_cases' => [],
            ],
            'handling-events' => [
                'content_html' => $this->getReactEventsContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat form dengan event handling untuk input dan submit.',
                'starter_code' => 'import { useState } from "react";\n\nfunction Form() {\n    \n}\n\n',
                'solution_code' => $this->getReactEventsSolution(),
                'test_cases' => [],
            ],
        ];

        $this->updateLessons($lessons);
    }

    private function seedLaravelLessons(): void
    {
        $lessons = [
            'what-is-laravel' => [
                'content_html' => $this->getLaravelIntroContent(),
                'programming_language' => 'php',
                'exercise_description' => 'Install Laravel dan buat project pertama.',
                'starter_code' => '// Command untuk install:\n// composer create-project laravel/laravel my-app\n// cd my-app\n// php artisan serve\n\n',
                'solution_code' => '// Setelah install, buat route di routes/web.php:\nRoute::get("/", function () {\n    return "Hello Laravel!";\n});',
                'test_cases' => [],
            ],
            'laravel-directory-structure' => [
                'content_html' => $this->getLaravelStructureContent(),
                'programming_language' => 'php',
                'exercise_description' => 'Explorasi struktur folder Laravel dan buat controller pertama.',
                'starter_code' => '// Buat controller:\n// php artisan make:controller HomeController\n\n',
                'solution_code' => '<?php\n\nnamespace App\\Http\\Controllers;\n\nuse Illuminate\\Http\\Request;\n\nclass HomeController extends Controller\n{\n    public function index()\n    {\n        return view("welcome");\n    }\n}',
                'test_cases' => [],
            ],
            'basic-routing' => [
                'content_html' => $this->getLaravelRoutingContent(),
                'programming_language' => 'php',
                'exercise_description' => 'Buat berbagai routes dengan Laravel.',
                'starter_code' => '// routes/web.php\n\n',
                'solution_code' => $this->getLaravelRoutingSolution(),
                'test_cases' => [],
            ],
            'creating-controllers' => [
                'content_html' => $this->getLaravelControllersContent(),
                'programming_language' => 'php',
                'exercise_description' => 'Buat Resource Controller untuk CRUD operations.',
                'starter_code' => '// php artisan make:controller PostController --resource\n\n',
                'solution_code' => $this->getLaravelControllersSolution(),
                'test_cases' => [],
            ],
            'introduction-to-eloquent' => [
                'content_html' => $this->getEloquentContent(),
                'programming_language' => 'php',
                'exercise_description' => 'Buat Model dan migration untuk Post.',
                'starter_code' => '// php artisan make:model Post -m\n\n',
                'solution_code' => $this->getEloquentSolution(),
                'test_cases' => [],
            ],
            'eloquent-relationships' => [
                'content_html' => $this->getEloquentRelationshipsContent(),
                'programming_language' => 'php',
                'exercise_description' => 'Buat relasi antara User dan Post (One to Many).',
                'starter_code' => '// Buat relasi di Model User dan Post\n\n',
                'solution_code' => $this->getEloquentRelationshipsSolution(),
                'test_cases' => [],
            ],
        ];

        $this->updateLessons($lessons);
    }

    private function updateLessons(array $lessonsData): void
    {
        foreach ($lessonsData as $slug => $data) {
            Lesson::where('slug', $slug)->update($data);
        }
    }

    // ==================== CONTENT METHODS ====================

    private function getHowWebWorksContent(): string
    {
        return <<<'MD'
# How the Web Works

## Introduction

Understanding how the web works is fundamental to becoming a web developer. In this lesson, we'll explore the client-server model, HTTP/HTTPS, and the journey of a web request.

## The Client-Server Model

### What is a Client?

A **client** is any device or software that requests resources from a server. In web development, the most common client is a **web browser** like Chrome, Firefox, or Safari.

### What is a Server?

A **server** is a computer or system that provides resources, data, or services to clients. Web servers store website files and deliver them to browsers upon request.

```
┌─────────────┐         HTTP Request         ┌─────────────┐
│   Client    │ ────────────────────────────>│   Server    │
│  (Browser)  │                              │  (Website)  │
│             │ <────────────────────────────│             │
└─────────────┘        HTTP Response         └─────────────┘
```

## HTTP and HTTPS

### HTTP (HyperText Transfer Protocol)

HTTP is the foundation of data communication on the web. It defines how messages are formatted and transmitted.

**HTTP Request Structure:**
```http
GET /index.html HTTP/1.1
Host: www.example.com
User-Agent: Mozilla/5.0
Accept: text/html
```

### HTTPS (Secure HTTP)

HTTPS is HTTP with encryption (SSL/TLS). It provides:
- **Encryption** - Data is encrypted for security
- **Authentication** - Verifies the server's identity
- **Integrity** - Data cannot be modified during transmission

## Key Takeaways

1. The web works on a **client-server model**
2. **HTTP/HTTPS** is the protocol for communication
3. **DNS** translates domain names to IP addresses
4. Every web interaction follows a **request-response cycle**

## Try It Yourself

In the code editor, create a simple HTML file to understand how web pages are structured!
MD;
    }

    private function getDevEnvironmentContent(): string
    {
        return <<<'MD'
# Setting Up Your Development Environment

## Essential Tools

### 1. Visual Studio Code

**Why VS Code?**
- Free and open-source
- Extensive extension ecosystem
- Built-in Git integration
- Intelligent code completion
- Integrated terminal

**Recommended Extensions:**
- Live Server
- Prettier - Code formatter
- ESLint
- Auto Rename Tag
- CSS Peek

### 2. Chrome Browser

**Why Chrome?**
- Excellent Developer Tools
- Fast performance
- Most popular browser

### 3. Git

**Why Git?**
- Track changes in your code
- Collaborate with others
- Backup and restore points

## Project Structure

```
my-project/
├── index.html
├── css/
│   └── style.css
├── js/
│   └── main.js
└── images/
```

## Try It Yourself

Create a proper project structure with all necessary folders and files!
MD;
    }

    private function getHtmlStructureContent(): string
    {
        return <<<'MD'
# HTML Document Structure

## Basic HTML5 Structure

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title</title>
</head>
<body>
    <!-- Content goes here -->
</body>
</html>
```

## Element Breakdown

### DOCTYPE Declaration
```html
<!DOCTYPE html>
```
- Tells browser this is an HTML5 document
- Must be the first line of HTML

### HTML Root Element
```html
<html lang="en">
```
- Root element of the page
- `lang` attribute specifies language

### Head Section
Contains metadata about the document.

```html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title</title>
</head>
```

### Body Section
Contains all visible content.

## Semantic HTML5 Elements

- `<header>` - Introductory content or navigation
- `<nav>` - Navigation links
- `<main>` - Main content
- `<article>` - Independent, self-contained content
- `<section>` - Thematic grouping of content
- `<aside>` - Content indirectly related to main content
- `<footer>` - Footer for section or page

## Best Practices

1. Always include `<!DOCTYPE html>`
2. Set `lang` attribute on html element
3. Include viewport meta tag for responsive design
4. Use semantic elements
5. Close all tags properly
MD;
    }

    private function getHtmlStructureSolution(): string
    {
        return <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My first semantic HTML page">
    <title>My Semantic Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }
        header {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            background: #444;
            padding: 10px;
        }
        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        main {
            padding: 20px;
        }
        article {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
        }
        aside {
            background: #f4f4f4;
            padding: 15px;
            margin: 20px 0;
        }
        footer {
            background: #333;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to My Website</h1>
        <nav>
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>
    
    <main>
        <article>
            <h2>Article Title</h2>
            <p>This is the main content of the article.</p>
            <section>
                <h3>Section 1</h3>
                <p>Content for section 1.</p>
            </section>
        </article>
        
        <aside>
            <h3>Related Links</h3>
            <ul>
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
            </ul>
        </aside>
    </main>
    
    <footer>
        <p>&copy; 2024 My Website. All rights reserved.</p>
    </footer>
</body>
</html>
HTML;
    }

    private function getTextElementsContent(): string
    {
        return <<<'MD'
# Working with Text Elements

## Headings

HTML provides six levels of headings from `<h1>` to `<h6>`.

```html
<h1>Main Heading</h1>
<h2>Section Heading</h2>
<h3>Subsection Heading</h3>
```

## Paragraphs

```html
<p>This is a paragraph of text.</p>
```

## Text Formatting

- `<strong>` - Strong importance (bold)
- `<em>` - Emphasized text (italic)
- `<mark>` - Highlighted text
- `<small>` - Small print
- `<del>` - Deleted text
- `<ins>` - Inserted text
- `<sub>` - Subscript
- `<sup>` - Superscript

## Lists

### Unordered List
```html
<ul>
    <li>Item 1</li>
    <li>Item 2</li>
</ul>
```

### Ordered List
```html
<ol>
    <li>First item</li>
    <li>Second item</li>
</ol>
```

## Blockquote

```html
<blockquote>
    <p>This is a quotation.</p>
    <cite>— Author Name</cite>
</blockquote>
```

## Code Elements

```html
<p>Use the <code>console.log()</code> function.</p>
<pre><code>function hello() {
    return "World";
}</code></pre>
```
MD;
    }

    private function getTextElementsSolution(): string
    {
        return <<<'HTML'
<article>
    <header>
        <h1>My Blog Post Title</h1>
        <p>Published on <time datetime="2024-03-14">March 14, 2024</time></p>
    </header>
    
    <section>
        <h2>Introduction</h2>
        <p>This is the <strong>introduction</strong> to my blog post. I'm excited to share this with you!</p>
        <p>Here's some <em>emphasized text</em> and some <mark>highlighted content</mark>.</p>
    </section>
    
    <section>
        <h2>Main Content</h2>
        <p>Here are the key points:</p>
        <ul>
            <li>First important point</li>
            <li>Second important point</li>
            <li>Third important point</li>
        </ul>
        
        <h3>Steps to Follow</h3>
        <ol>
            <li>Step one: Get started</li>
            <li>Step two: Learn the basics</li>
            <li>Step three: Practice</li>
        </ol>
    </section>
    
    <section>
        <h2>Code Example</h2>
        <p>Here's how you write a function:</p>
        <pre><code>function greet(name) {
    return "Hello, " + name + "!";
}</code></pre>
    </section>
    
    <blockquote>
        <p>The only way to do great work is to love what you do.</p>
        <cite>— Steve Jobs</cite>
    </blockquote>
</article>
HTML;
    }

    private function getLinksImagesContent(): string
    {
        return <<<'MD'
# Links, Images, and Media

## Hyperlinks

```html
<!-- External link -->
<a href="https://example.com">Visit Example</a>

<!-- Internal link -->
<a href="/about">About Us</a>

<!-- Anchor link -->
<a href="#section1">Jump to Section</a>

<!-- Email link -->
<a href="mailto:info@example.com">Email Us</a>

<!-- Phone link -->
<a href="tel:+1234567890">Call Us</a>
```

## Images

```html
<img src="image.jpg" alt="Description" width="800" height="600" loading="lazy">
```

### Image Best Practices
- Always include `alt` text for accessibility
- Use `loading="lazy"` for performance
- Specify `width` and `height` to prevent layout shift

## Responsive Images

```html
<img src="image-800.jpg" 
     srcset="image-400.jpg 400w, image-800.jpg 800w"
     sizes="(max-width: 600px) 400px, 800px"
     alt="Responsive image">
```

## Video

```html
<video controls width="640" poster="thumbnail.jpg">
    <source src="video.mp4" type="video/mp4">
    <source src="video.webm" type="video/webm">
    Your browser does not support the video tag.
</video>
```

## Audio

```html
<audio controls>
    <source src="audio.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
</audio>
```
MD;
    }

    private function getLinksImagesSolution(): string
    {
        return <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Links and Media</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        nav {
            background: #333;
            padding: 15px;
            margin-bottom: 20px;
        }
        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .gallery img {
            width: 100%;
            border-radius: 8px;
        }
        .video-container {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <nav>
        <a href="#home">Home</a>
        <a href="#gallery">Gallery</a>
        <a href="#video">Video</a>
        <a href="mailto:contact@example.com">Contact</a>
    </nav>
    
    <main id="home">
        <h1>Links and Media Demo</h1>
        
        <section id="gallery">
            <h2>Image Gallery</h2>
            <div class="gallery">
                <img src="https://via.placeholder.com/400x300/3498db/ffffff?text=Image+1" alt="Placeholder 1">
                <img src="https://via.placeholder.com/400x300/2ecc71/ffffff?text=Image+2" alt="Placeholder 2">
                <img src="https://via.placeholder.com/400x300/e74c3c/ffffff?text=Image+3" alt="Placeholder 3">
            </div>
        </section>
        
        <section id="video">
            <h2>Video Section</h2>
            <div class="video-container">
                <video controls width="640" poster="https://via.placeholder.com/640x360/333/fff?text=Video+Thumbnail">
                    <source src="sample.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>
    </main>
    
    <footer>
        <p>
            <a href="https://example.com" target="_blank" rel="noopener noreferrer">External Link</a>
        </p>
    </footer>
</body>
</html>
HTML;
    }

    private function getListsTablesFormsContent(): string
    {
        return <<<'MD'
# Lists, Tables, and Forms

## Forms

```html
<form action="/submit" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Submit</button>
</form>
```

## Input Types

- `text` - Text input
- `email` - Email validation
- `password` - Password field
- `number` - Number input
- `date` - Date picker
- `checkbox` - Checkbox
- `radio` - Radio button
- `select` - Dropdown
- `textarea` - Multi-line text
- `file` - File upload

## Form Validation

```html
<input type="text" required minlength="3" maxlength="50" pattern="[A-Za-z]+">
```

## Tables

```html
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>John</td>
            <td>25</td>
        </tr>
    </tbody>
</table>
```
MD;
    }

    private function getListsTablesFormsSolution(): string
    {
        return <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background: #3498db;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #2980b9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>User Registration</h1>
    
    <form action="/register" method="POST">
        <div class="form-group">
            <label for="fullname">Full Name *</label>
            <input type="text" id="fullname" name="fullname" required minlength="3">
        </div>
        
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" id="password" name="password" required minlength="8">
        </div>
        
        <div class="form-group">
            <label for="country">Country</label>
            <select id="country" name="country">
                <option value="">Select Country</option>
                <option value="id">Indonesia</option>
                <option value="us">United States</option>
                <option value="uk">United Kingdom</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea id="bio" name="bio" rows="4" maxlength="500"></textarea>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="terms" required>
                I agree to the terms and conditions
            </label>
        </div>
        
        <button type="submit">Register</button>
    </form>
    
    <h2>Registered Users</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>Indonesia</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>jane@example.com</td>
                <td>United States</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
HTML;
    }

    private function getCssSyntaxContent(): string
    {
        return <<<'MD'
# CSS Syntax and Selectors

## CSS Syntax

```css
selector {
    property: value;
    property: value;
}
```

## Selectors

### Element Selector
```css
p {
    color: blue;
}
```

### Class Selector
```css
.text-large {
    font-size: 18px;
}
```

### ID Selector
```css
#header {
    background: #333;
}
```

### Attribute Selector
```css
input[type="text"] {
    border: 1px solid #ccc;
}
```

### Pseudo-classes
```css
a:hover {
    color: red;
}

li:first-child {
    font-weight: bold;
}
```

### Combinators
```css
/* Descendant */
div p { }

/* Child */
div > p { }

/* Adjacent sibling */
h1 + p { }

/* General sibling */
h1 ~ p { }
```
MD;
    }

    private function getCssSyntaxSolution(): string
    {
        return <<<'CSS'
/* Element Selector */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
}

/* Class Selector */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.btn:hover {
    background: #2980b9;
}

/* ID Selector */
#main-header {
    background: #333;
    color: white;
    padding: 20px;
}

/* Attribute Selector */
input[type="email"] {
    border: 2px solid #3498db;
}

a[href^="https"] {
    color: green;
}

/* Pseudo-classes */
ul li:first-child {
    font-weight: bold;
}

ul li:last-child {
    margin-bottom: 0;
}

/* Combinators */
article > h2 {
    color: #333;
}

h1 + p {
    font-size: 18px;
}

.card .content p {
    color: #666;
}
CSS;
    }

    private function getBoxModelContent(): string
    {
        return <<<'MD'
# The Box Model Explained

## Box Model Components

```
┌─────────────────────────────────┐
│           Margin                │
│  ┌───────────────────────────┐  │
│  │         Border            │  │
│  │  ┌─────────────────────┐  │  │
│  │  │      Padding        │  │  │
│  │  │  ┌───────────────┐  │  │  │
│  │  │  │    Content    │  │  │  │
│  │  │  └───────────────┘  │  │  │
│  │  └─────────────────────┘  │  │
│  └───────────────────────────┘  │
└─────────────────────────────────┘
```

## CSS Properties

```css
.box {
    width: 300px;
    padding: 20px;
    border: 5px solid #333;
    margin: 30px;
}
```

## Box-Sizing

```css
/* Default: width = content only */
box-sizing: content-box;

/* Better: width = content + padding + border */
box-sizing: border-box;
```

## Best Practice

```css
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
```
MD;
    }

    private function getBoxModelSolution(): string
    {
        return <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Box Model Demo</title>
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        
        .card {
            width: 300px;
            margin: 20px;
            padding: 20px;
            border: 3px solid #3498db;
            background: #ecf0f1;
        }
        
        .card h3 {
            margin-top: 0;
            color: #2c3e50;
        }
        
        .card p {
            color: #7f8c8d;
            line-height: 1.6;
        }
        
        .box-model-visual {
            background: #f39c12;
            padding: 20px;
            margin: 20px 0;
            border: 5px solid #e74c3c;
        }
        
        .box-model-visual .content {
            background: #2ecc71;
            padding: 20px;
            text-align: center;
            color: white;
        }
        
        .label {
            position: absolute;
            font-size: 12px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Box Model Demonstration</h1>
    
    <div class="box-model-visual">
        <div class="content">
            Content
        </div>
    </div>
    
    <div class="card">
        <h3>Card Component</h3>
        <p>This card demonstrates the box model with margin, border, padding, and content areas.</p>
        <p>Total width = margin + border + padding + content</p>
    </div>
    
    <div class="card" style="border-style: dashed;">
        <h3>Another Card</h3>
        <p>Different border style but same box model principles apply.</p>
    </div>
</body>
</html>
HTML;
    }

    private function getFlexboxContent(): string
    {
        return <<<'MD'
# Flexbox Fundamentals

## Basic Flexbox

```css
.container {
    display: flex;
}
```

## Main Axis Properties (Container)

```css
.container {
    flex-direction: row;        /* row, row-reverse, column, column-reverse */
    justify-content: flex-start; /* flex-start, flex-end, center, space-between, space-around */
    align-items: stretch;       /* flex-start, flex-end, center, stretch, baseline */
    flex-wrap: nowrap;          /* nowrap, wrap, wrap-reverse */
    gap: 20px;
}
```

## Item Properties

```css
.item {
    flex-grow: 0;    /* Don't grow */
    flex-shrink: 1;  /* Shrink if needed */
    flex-basis: auto;
    align-self: auto;
    order: 0;
}
```

## Shorthand

```css
.item {
    flex: 0 1 auto;  /* grow shrink basis */
}
```
MD;
    }

    private function getFlexboxSolution(): string
    {
        return <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flexbox Navigation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #2c3e50;
            padding: 15px 30px;
        }
        
        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background 0.3s;
        }
        
        .nav-links a:hover {
            background: #3498db;
        }
        
        .nav-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
        
        .btn-outline {
            border: 2px solid white;
            color: white;
        }
        
        .btn-filled {
            background: #3498db;
            color: white;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 20px;
            }
            
            .nav-links {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Brand</div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="nav-buttons">
            <a href="#" class="btn btn-outline">Login</a>
            <a href="#" class="btn btn-filled">Sign Up</a>
        </div>
    </nav>
    
    <main style="padding: 30px;">
        <h1>Flexbox Navigation Demo</h1>
        <p>Resize the browser to see the responsive behavior!</p>
    </main>
</body>
</html>
HTML;
    }

    // JavaScript Content Methods
    private function getIntroToJSContent(): string
    {
        return <<<'MD'
# Introduction to JavaScript

## What is JavaScript?

JavaScript is a programming language that adds interactivity to websites. It's one of the three core technologies of the web, along with HTML and CSS.

## What Can JavaScript Do?

- **Manipulate HTML** - Change content, styles, and structure dynamically
- **Respond to Events** - React to user actions like clicks, keypresses
- **Validate Forms** - Check user input before submitting
- **Create Animations** - Move elements, fade in/out
- **Make API Calls** - Fetch data from servers without reloading

## Your First JavaScript

```javascript
// This is a comment
console.log("Hello, World!");

// Declare a variable
let message = "Welcome to JavaScript!";
console.log(message);

// Do some math
let sum = 5 + 3;
console.log("5 + 3 = " + sum);
```

## JavaScript Syntax Basics

### Statements
JavaScript statements are instructions ending with a semicolon.

```javascript
let x = 5;
let y = 10;
let result = x + y;
```

### Comments
```javascript
// Single-line comment

/*
  Multi-line comment
*/
```

### Output
```javascript
console.log("Message");  // Console output
alert("Warning!");       // Alert box
```
MD;
    }

    private function getVariablesContent(): string
    {
        return <<<'MD'
# Variables and Data Types

## Declaring Variables

### let - Block Scoped, Reassignable
```javascript
let count = 0;
count = 1; // ✓ Can reassign
```

### const - Block Scoped, Cannot Reassign
```javascript
const PI = 3.14;
PI = 3; // ✗ Error!
```

### var - Function Scoped (Legacy)
```javascript
var name = 'John'; // Avoid in modern code
```

## Data Types

### Primitive Types
```javascript
// String
const text = 'Hello';

// Number
const int = 42;
const float = 3.14;

// Boolean
const isTrue = true;

// Null
const empty = null;

// Undefined
let notDefined; // undefined
```

### Reference Types
```javascript
// Object
const person = {
    name: 'John',
    age: 30
};

// Array
const numbers = [1, 2, 3];
```

## Type Checking
```javascript
typeof 'Hello'   // "string"
typeof 42        // "number"
typeof true      // "boolean"
typeof {}        // "object"
typeof []        // "object"
```
MD;
    }

    private function getVariablesSolution(): string
    {
        return <<<'JS'
// String variables
const greeting = "Hello, World!";
let name = "Developer";

// Number variables
let age = 25;
const pi = 3.14159;

// Boolean variables
let isLearning = true;
let isExpert = false;

// Null and Undefined
let emptyValue = null;
let notDefined;

// Object
const person = {
    firstName: "John",
    lastName: "Doe",
    age: 30,
    hobbies: ["coding", "reading", "gaming"]
};

// Array
const colors = ["red", "green", "blue"];

// Print all variables
console.log(greeting);
console.log("Name:", name);
console.log("Age:", age);
console.log("Pi:", pi);
console.log("Is Learning:", isLearning);
console.log("Person:", person);
console.log("Colors:", colors);
console.log("First color:", colors[0]);
console.log("Person's hobbies:", person.hobbies);
JS;
    }

    private function getConditionalsContent(): string
    {
        return <<<'MD'
# Conditional Statements

## if/else

```javascript
let age = 18;

if (age >= 18) {
    console.log("Adult");
} else {
    console.log("Minor");
}
```

## else if

```javascript
let score = 85;

if (score >= 90) {
    grade = "A";
} else if (score >= 80) {
    grade = "B";
} else if (score >= 70) {
    grade = "C";
} else {
    grade = "F";
}
```

## Ternary Operator

```javascript
let age = 20;
let status = (age >= 18) ? "Adult" : "Minor";
```

## Switch Statement

```javascript
let day = "Monday";

switch (day) {
    case "Monday":
        console.log("Start of week");
        break;
    case "Friday":
        console.log("End of week");
        break;
    default:
        console.log("Midweek");
}
```
MD;
    }

    private function getConditionalsSolution(): string
    {
        return <<<'JS'
// Grading System
function getGrade(score) {
    if (score >= 90) {
        return "A - Excellent!";
    } else if (score >= 80) {
        return "B - Good job!";
    } else if (score >= 70) {
        return "C - Keep trying!";
    } else if (score >= 60) {
        return "D - Needs improvement";
    } else {
        return "F - Failed";
    }
}

// Test the function
console.log("Score: 95 ->", getGrade(95));
console.log("Score: 85 ->", getGrade(85));
console.log("Score: 75 ->", getGrade(75));
console.log("Score: 65 ->", getGrade(65));
console.log("Score: 55 ->", getGrade(55));

// Using ternary for simple condition
function checkAge(age) {
    return (age >= 18) ? "Adult" : "Minor";
}

console.log("Age 20:", checkAge(20));
console.log("Age 15:", checkAge(15));

// Switch example
function getDayType(day) {
    switch (day) {
        case "Saturday":
        case "Sunday":
            return "Weekend!";
        case "Friday":
            return "Almost weekend!";
        default:
            return "Weekday";
    }
}

console.log("Monday:", getDayType("Monday"));
console.log("Friday:", getDayType("Friday"));
console.log("Sunday:", getDayType("Sunday"));
JS;
    }

    private function getLoopsContent(): string
    {
        return <<<'MD'
# Loops

## for Loop

```javascript
for (let i = 0; i < 5; i++) {
    console.log(i);
}
```

## while Loop

```javascript
let i = 0;
while (i < 5) {
    console.log(i);
    i++;
}
```

## do...while Loop

```javascript
let i = 0;
do {
    console.log(i);
    i++;
} while (i < 5);
```

## for...of (Arrays)

```javascript
const arr = [1, 2, 3];
for (let value of arr) {
    console.log(value);
}
```

## for...in (Objects)

```javascript
const obj = { a: 1, b: 2 };
for (let key in obj) {
    console.log(key, obj[key]);
}
```
MD;
    }

    private function getLoopsSolution(): string
    {
        return <<<'JS'
// Print numbers 1-10 and calculate sum
let sum = 0;

console.log("Numbers 1-10:");
for (let i = 1; i <= 10; i++) {
    console.log(i);
    sum += i;
}

console.log("Total sum:", sum);

// While loop - countdown
console.log("\nCountdown:");
let count = 5;
while (count > 0) {
    console.log(count);
    count--;
}
console.log("Blast off!");

// Do...while - at least once
console.log("\nDo...While:");
let num = 0;
do {
    console.log("Number:", num);
    num++;
} while (num < 3);

// For...of - array iteration
console.log("\nArray iteration:");
const fruits = ["Apple", "Banana", "Orange"];
for (const fruit of fruits) {
    console.log(fruit);
}

// For...in - object iteration
console.log("\nObject iteration:");
const person = { name: "John", age: 30, city: "NYC" };
for (const key in person) {
    console.log(key + ":", person[key]);
}
JS;
    }

    private function getFunctionsContent(): string
    {
        return <<<'MD'
# Functions

## Function Declaration

```javascript
function greet(name) {
    return "Hello, " + name;
}
```

## Function Expression

```javascript
const greet = function(name) {
    return "Hello, " + name;
};
```

## Arrow Function

```javascript
const greet = (name) => {
    return "Hello, " + name;
};

// Shorthand
const greet = name => "Hello, " + name;
```

## Default Parameters

```javascript
function greet(name = "Guest") {
    return "Hello, " + name;
}
```

## Rest Parameters

```javascript
function sum(...numbers) {
    return numbers.reduce((a, b) => a + b, 0);
}
```
MD;
    }

    private function getFunctionsSolution(): string
    {
        return <<<'JS'
// Function declaration
function add(a, b) {
    return a + b;
}

console.log("Add:", add(5, 3));

// Function expression
const subtract = function(a, b) {
    return a - b;
};

console.log("Subtract:", subtract(10, 4));

// Arrow function
const multiply = (a, b) => a * b;

console.log("Multiply:", multiply(6, 7));

// Default parameters
function greet(name = "Guest") {
    return "Hello, " + name + "!";
}

console.log(greet());
console.log(greet("John"));

// Rest parameters
function sum(...numbers) {
    return numbers.reduce((total, num) => total + num, 0);
}

console.log("Sum:", sum(1, 2, 3, 4, 5));

// Multiple return values
function getPerson() {
    return {
        name: "John",
        age: 30
    };
}

const person = getPerson();
console.log("Person:", person);
JS;
    }

    private function getArraysContent(): string
    {
        return <<<'MD'
# Arrays and Array Methods

## Creating Arrays

```javascript
const arr = [1, 2, 3];
const arr2 = new Array(1, 2, 3);
```

## Accessing Elements

```javascript
arr[0];        // 1
arr.length;    // 3
arr.at(-1);    // 3 (last element)
```

## Array Methods

### map
```javascript
const doubled = [1, 2, 3].map(x => x * 2);
// [2, 4, 6]
```

### filter
```javascript
const evens = [1, 2, 3, 4].filter(x => x % 2 === 0);
// [2, 4]
```

### reduce
```javascript
const sum = [1, 2, 3].reduce((acc, x) => acc + x, 0);
// 6
```

### forEach
```javascript
[1, 2, 3].forEach(x => console.log(x));
```

### find
```javascript
const found = [1, 2, 3].find(x => x > 1);
// 2
```

### some/every
```javascript
[1, 2, 3].some(x => x > 2);    // true
[1, 2, 3].every(x => x > 0);   // true
```
MD;
    }

    private function getArraysSolution(): string
    {
        return <<<'JS'
// Original array
const numbers = [1, 2, 3, 4, 5];

// map - transform each element
const doubled = numbers.map(n => n * 2);
console.log("Doubled:", doubled);

// filter - keep elements that pass test
const evens = numbers.filter(n => n % 2 === 0);
console.log("Evens:", evens);

// reduce - reduce to single value
const sum = numbers.reduce((acc, n) => acc + n, 0);
console.log("Sum:", sum);

// forEach - iterate without returning
console.log("ForEach:");
numbers.forEach(n => console.log("  ", n));

// find - find first matching element
const found = numbers.find(n => n > 3);
console.log("Found:", found);

// some - check if any match
const hasEven = numbers.some(n => n % 2 === 0);
console.log("Has even:", hasEven);

// every - check if all match
const allPositive = numbers.every(n => n > 0);
console.log("All positive:", allPositive);

// sort
const unsorted = [3, 1, 4, 1, 5];
console.log("Sorted:", unsorted.sort((a, b) => a - b));

// slice - get portion of array
console.log("Slice:", numbers.slice(1, 4));

// splice - modify array
const arr = [1, 2, 3, 4, 5];
arr.splice(2, 1, 'a', 'b');
console.log("After splice:", arr);
JS;
    }

    private function getObjectsContent(): string
    {
        return <<<'MD'
# Objects

## Creating Objects

```javascript
const person = {
    name: "John",
    age: 30,
    greet() {
        console.log("Hello!");
    }
};
```

## Accessing Properties

```javascript
person.name;      // "John"
person["age"];    // 30
```

## Object Methods

```javascript
Object.keys(person);    // ["name", "age"]
Object.values(person);  // ["John", 30]
Object.entries(person); // [["name", "John"], ["age", 30]]
```

## Destructuring

```javascript
const { name, age } = person;
```

## Spread Operator

```javascript
const updated = { ...person, city: "NYC" };
```
MD;
    }

    private function getObjectsSolution(): string
    {
        return <<<'JS'
// Create object
const user = {
    firstName: "John",
    lastName: "Doe",
    age: 30,
    email: "john@example.com",
    hobbies: ["coding", "reading"],
    
    // Method
    getFullName() {
        return this.firstName + " " + this.lastName;
    },
    
    greet() {
        return "Hello, I'm " + this.getFullName();
    }
};

// Access properties
console.log("Name:", user.firstName);
console.log("Full Name:", user.getFullName());
console.log("Greeting:", user.greet());

// Object methods
console.log("Keys:", Object.keys(user));
console.log("Values:", Object.values(user));

// Destructuring
const { firstName, age } = user;
console.log("First:", firstName, "Age:", age);

// Spread operator
const updatedUser = {
    ...user,
    city: "New York",
    age: 31
};

console.log("Updated:", updatedUser);

// Nested object
const company = {
    name: "Tech Corp",
    employees: [user],
    address: {
        city: "NYC",
        street: "123 Main St"
    }
};

console.log("Company:", company);
JS;
    }

    private function getDOMContent(): string
    {
        return <<<'MD'
# Introduction to the DOM

## What is the DOM?

The Document Object Model (DOM) is a programming interface for HTML documents.

## Selecting Elements

```javascript
// By ID
document.getElementById('myId');

// By class
document.querySelector('.myClass');
document.querySelectorAll('.myClass');

// By tag
document.querySelector('div');

// CSS selectors
document.querySelector('#id .class');
```

## Manipulating Elements

```javascript
// Change content
element.textContent = "New text";
element.innerHTML = "<strong>Bold</strong>";

// Change style
element.style.color = "red";
element.style.fontSize = "20px";

// Add/remove classes
element.classList.add('active');
element.classList.remove('active');
element.classList.toggle('active');
```

## Creating Elements

```javascript
const div = document.createElement('div');
div.textContent = "Hello";
document.body.appendChild(div);
```
MD;
    }

    private function getDOMSolution(): string
    {
        return <<<'JS'
// Note: This code runs in browser environment
// Example DOM manipulation

// Select element
const heading = document.querySelector('h1');

// Change content
heading.textContent = "New Heading!";

// Change style
heading.style.color = "blue";
heading.style.fontSize = "36px";

// Add class
heading.classList.add('highlight');

// Create new element
const paragraph = document.createElement('p');
paragraph.textContent = "This is a new paragraph.";
paragraph.style.color = "green";

// Append to DOM
document.body.appendChild(paragraph);

// Create list
const ul = document.createElement('ul');
const items = ['Item 1', 'Item 2', 'Item 3'];

items.forEach(text => {
    const li = document.createElement('li');
    li.textContent = text;
    ul.appendChild(li);
});

document.body.appendChild(ul);

// Remove element
// element.remove();
JS;
    }

    private function getEventsContent(): string
    {
        return <<<'MD'
# Event Handling

## Adding Event Listeners

```javascript
element.addEventListener('click', handler);
```

## Common Events

- `click` - Mouse click
- `submit` - Form submission
- `change` - Input change
- `input` - Input value change
- `keydown` - Key pressed
- `mouseover` - Mouse over element
- `load` - Page/resource loaded

## Event Object

```javascript
element.addEventListener('click', (e) => {
    e.preventDefault();
    e.target;      // Element clicked
    e.type;        // Event type
});
```

## Event Delegation

```javascript
parent.addEventListener('click', (e) => {
    if (e.target.matches('.child')) {
        // Handle child click
    }
});
```
MD;
    }

    private function getEventsSolution(): string
    {
        return <<<'JS'
// Note: This code runs in browser environment

// Click event
const button = document.querySelector('#myButton');
button.addEventListener('click', (e) => {
    console.log("Button clicked!");
    console.log("Event:", e.type);
    console.log("Target:", e.target);
});

// Form submit
const form = document.querySelector('#myForm');
form.addEventListener('submit', (e) => {
    e.preventDefault();
    console.log("Form submitted!");
    
    // Get form data
    const formData = new FormData(form);
    console.log("Data:", Object.fromEntries(formData));
});

// Input change
const input = document.querySelector('#myInput');
input.addEventListener('input', (e) => {
    console.log("Input value:", e.target.value);
});

// Key events
document.addEventListener('keydown', (e) => {
    console.log("Key pressed:", e.key);
});

// Event delegation
const list = document.querySelector('#myList');
list.addEventListener('click', (e) => {
    if (e.target.matches('li')) {
        console.log("List item clicked:", e.target.textContent);
    }
});
JS;
    }

    private function getPromisesContent(): string
    {
        return <<<'MD'
# Promises

## What is a Promise?

A Promise represents the eventual completion (or failure) of an asynchronous operation.

## States

- **Pending** - Initial state
- **Fulfilled** - Operation completed successfully
- **Rejected** - Operation failed

## Creating Promises

```javascript
const promise = new Promise((resolve, reject) => {
    setTimeout(() => {
        resolve("Success!");
        // reject("Error!");
    }, 1000);
});
```

## Using Promises

```javascript
promise
    .then(result => console.log(result))
    .catch(error => console.error(error))
    .finally(() => console.log("Done"));
```

## Chaining

```javascript
fetch('/api/data')
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error(error));
```
MD;
    }

    private function getPromisesSolution(): string
    {
        return <<<'JS'
// Create a promise
const myPromise = new Promise((resolve, reject) => {
    const success = true;
    
    setTimeout(() => {
        if (success) {
            resolve("Operation completed successfully!");
        } else {
            reject("Operation failed!");
        }
    }, 1000);
});

// Use the promise
myPromise
    .then(result => {
        console.log("Success:", result);
        return "Next value";
    })
    .then(nextValue => {
        console.log("Chained:", nextValue);
    })
    .catch(error => {
        console.error("Error:", error);
    })
    .finally(() => {
        console.log("Promise settled");
    });

// Promise.all - wait for all promises
const promise1 = Promise.resolve(1);
const promise2 = Promise.resolve(2);
const promise3 = Promise.resolve(3);

Promise.all([promise1, promise2, promise3])
    .then(values => console.log("All:", values));

// Promise.race - first to settle
Promise.race([promise1, promise2])
    .then(first => console.log("First:", first));

// Async simulation
function fetchData() {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve({ id: 1, name: "John" });
        }, 1000);
    });
}

fetchData().then(data => console.log("Data:", data));
JS;
    }

    private function getAsyncAwaitContent(): string
    {
        return <<<'MD'
# Async/Await

## Async Functions

```javascript
async function fetchData() {
    return "data";
}
```

## Await

```javascript
async function getData() {
    const result = await fetchData();
    console.log(result);
}
```

## Error Handling

```javascript
async function getData() {
    try {
        const result = await fetchData();
        console.log(result);
    } catch (error) {
        console.error(error);
    }
}
```

## Parallel Execution

```javascript
const [data1, data2] = await Promise.all([
    fetchApi1(),
    fetchApi2()
]);
```
MD;
    }

    private function getAsyncAwaitSolution(): string
    {
        return <<<'JS'
// Async function
async function fetchData() {
    return new Promise(resolve => {
        setTimeout(() => {
            resolve({ id: 1, name: "John" });
        }, 1000);
    });
}

// Using async/await
async function getData() {
    try {
        const data = await fetchData();
        console.log("Data:", data);
        return data;
    } catch (error) {
        console.error("Error:", error);
    }
}

getData();

// Multiple awaits
async function getUserData() {
    const user = await fetchUser();
    const posts = await fetchPosts(user.id);
    return { user, posts };
}

// Parallel execution
async function getAllData() {
    const [user, posts, comments] = await Promise.all([
        fetchUser(),
        fetchPosts(),
        fetchComments()
    ]);
    return { user, posts, comments };
}

// Async/await with forEach
async function processItems(items) {
    for (const item of items) {
        await processItem(item);
    }
}

// Helper functions
function fetchUser() {
    return Promise.resolve({ id: 1, name: "John" });
}

function fetchPosts(userId) {
    return Promise.resolve([{ id: 1, title: "Post 1" }]);
}

function fetchComments() {
    return Promise.resolve([{ id: 1, text: "Comment 1" }]);
}

function processItem(item) {
    return new Promise(resolve => {
        setTimeout(() => {
            console.log("Processed:", item);
            resolve();
        }, 500);
    });
}
JS;
    }

    // Node.js Content Methods
    private function getWhatIsNodeJSContent(): string
    {
        return <<<'MD'
# What is Node.js?

## Introduction

Node.js is a JavaScript runtime built on Chrome's V8 JavaScript engine. It allows you to run JavaScript on the server.

## Why Node.js?

### 1. JavaScript Everywhere
Use the same language for both frontend and backend.

### 2. Fast and Efficient
- Built on Chrome's V8 engine
- Non-blocking I/O model
- Event-driven architecture

### 3. Large Ecosystem
- NPM has over 2 million packages
- Active community

### 4. Scalable
- Handles thousands of concurrent connections
- Perfect for real-time applications

## Use Cases

- REST APIs
- Real-time Apps (chat, gaming)
- Microservices
- Command Line Tools
- Serverless Functions

## Your First Node.js Program

```javascript
console.log("Hello from Node.js!");

console.log(`Node.js version: ${process.version}`);
console.log(`Platform: ${process.platform}`);
```
MD;
    }

    private function getInstallingNodeJSContent(): string
    {
        return <<<'MD'
# Installing Node.js and NPM

## Installation

### Windows/Mac
1. Download from [nodejs.org](https://nodejs.org)
2. Run installer (choose LTS version)
3. Verify installation:
```bash
node --version
npm --version
```

### Linux (Ubuntu)
```bash
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt-get install -y nodejs
```

## NPM Basics

```bash
# Initialize project
npm init -y

# Install package
npm install express

# Install as dev dependency
npm install --save-dev nodemon

# Install globally
npm install -g nodemon

# Run script
npm run start
```

## package.json

```json
{
  "name": "my-app",
  "version": "1.0.0",
  "scripts": {
    "start": "node index.js",
    "dev": "nodemon index.js"
  },
  "dependencies": {
    "express": "^4.18.0"
  }
}
```
MD;
    }

    private function getFSModuleContent(): string
    {
        return <<<'MD'
# File System (fs) Module

## Reading Files

```javascript
const fs = require('fs');

// Synchronous
const data = fs.readFileSync('file.txt', 'utf8');

// Asynchronous
fs.readFile('file.txt', 'utf8', (err, data) => {
    console.log(data);
});

// Promise-based
const fs = require('fs').promises;
const data = await fs.readFile('file.txt', 'utf8');
```

## Writing Files

```javascript
// Write file
fs.writeFileSync('file.txt', 'Hello World');

// Append
fs.appendFileSync('file.txt', '\nMore content');

// Async
fs.writeFile('file.txt', 'Hello', (err) => {
    console.log('File written!');
});
```

## Other Operations

```javascript
// Delete
fs.unlinkSync('file.txt');

// Rename
fs.renameSync('old.txt', 'new.txt');

// Check exists
fs.existsSync('file.txt');

// Create directory
fs.mkdirSync('folder');
```
MD;
    }

    private function getFSModuleSolution(): string
    {
        return <<<'JS'
const fs = require('fs');

// Read file synchronously
try {
    const data = fs.readFileSync('example.txt', 'utf8');
    console.log("File content:", data);
} catch (err) {
    console.log("File not found, creating...");
    fs.writeFileSync('example.txt', 'Hello Node.js!');
}

// Write file asynchronously
fs.writeFile('output.txt', 'Hello World!', (err) => {
    if (err) {
        console.error("Error:", err);
    } else {
        console.log("File written successfully!");
    }
});

// Append to file
fs.appendFile('output.txt', '\nAppended content', (err) => {
    if (!err) console.log("Content appended!");
});

// Read directory
fs.readdir('.', (err, files) => {
    console.log("Files in directory:", files);
});

// Using promises
const fsPromises = require('fs').promises;

async function fileOperations() {
    try {
        await fsPromises.writeFile('promise.txt', 'Using promises!');
        const content = await fsPromises.readFile('promise.txt', 'utf8');
        console.log("Promise content:", content);
        await fsPromises.unlink('promise.txt');
        console.log("File deleted!");
    } catch (err) {
        console.error("Error:", err);
    }
}

fileOperations();
JS;
    }

    private function getHTTPModuleContent(): string
    {
        return <<<'MD'
# HTTP Module

## Creating a Server

```javascript
const http = require('http');

const server = http.createServer((req, res) => {
    res.writeHead(200, { 'Content-Type': 'text/plain' });
    res.end('Hello World');
});

server.listen(3000, () => {
    console.log('Server running at http://localhost:3000');
});
```

## Handling Routes

```javascript
const server = http.createServer((req, res) => {
    if (req.url === '/') {
        res.writeHead(200);
        res.end('Home');
    } else if (req.url === '/about') {
        res.writeHead(200);
        res.end('About');
    } else {
        res.writeHead(404);
        res.end('Not Found');
    }
});
```

## Reading Request Data

```javascript
// Query string
const url = require('url');
const parsed = url.parse(req.url, true);
const query = parsed.query;

// POST data
let body = '';
req.on('data', chunk => body += chunk);
req.on('end', () => console.log(body));
```
MD;
    }

    private function getHTTPModuleSolution(): string
    {
        return <<<'JS'
const http = require('http');

const server = http.createServer((req, res) => {
    // Set CORS headers
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Content-Type', 'application/json');
    
    // Simple routing
    if (req.url === '/' && req.method === 'GET') {
        res.writeHead(200);
        res.end(JSON.stringify({ message: 'Welcome to my server!' }));
    } else if (req.url === '/api/time' && req.method === 'GET') {
        res.writeHead(200);
        res.end(JSON.stringify({ time: new Date().toISOString() }));
    } else if (req.url === '/api/echo' && req.method === 'POST') {
        let body = '';
        req.on('data', chunk => body += chunk);
        req.on('end', () => {
            res.writeHead(200);
            res.end(JSON.stringify({ received: body }));
        });
    } else {
        res.writeHead(404);
        res.end(JSON.stringify({ error: 'Not Found' }));
    }
});

const PORT = 3000;
server.listen(PORT, () => {
    console.log(`Server running at http://localhost:${PORT}`);
    console.log('Endpoints:');
    console.log('  GET  /           - Welcome message');
    console.log('  GET  /api/time   - Current time');
    console.log('  POST /api/echo   - Echo request body');
});
JS;
    }

    private function getIntroToExpressContent(): string
    {
        return <<<'MD'
# Introduction to Express.js

## What is Express?

Express is a minimal Node.js web application framework.

## Installation

```bash
npm install express
```

## Basic Server

```javascript
const express = require('express');
const app = express();
const PORT = 3000;

app.get('/', (req, res) => {
    res.send('Hello World!');
});

app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});
```

## Response Methods

```javascript
res.send('Hello');           // Send response
res.json({ key: 'value' });  // Send JSON
res.sendFile('index.html');  // Send file
res.status(404).send('Not Found');
res.redirect('/new-path');
```
MD;
    }

    private function getIntroToExpressSolution(): string
    {
        return <<<'JS'
const express = require('express');
const app = express();
const PORT = 3000;

// Middleware to parse JSON
app.use(express.json());

// Home route
app.get('/', (req, res) => {
    res.json({ 
        message: 'Welcome to Express!',
        timestamp: new Date().toISOString()
    });
});

// About route
app.get('/about', (req, res) => {
    res.send('About page');
});

// API route
app.get('/api/users', (req, res) => {
    res.json([
        { id: 1, name: 'John' },
        { id: 2, name: 'Jane' }
    ]);
});

// 404 handler
app.use((req, res) => {
    res.status(404).json({ error: 'Not Found' });
});

// Start server
app.listen(PORT, () => {
    console.log(`Server running at http://localhost:${PORT}`);
});
JS;
    }

    private function getExpressRoutingContent(): string
    {
        return <<<'MD'
# Routing in Express

## Basic Routes

```javascript
app.get('/path', (req, res) => {});
app.post('/path', (req, res) => {});
app.put('/path', (req, res) => {});
app.delete('/path', (req, res) => {});
```

## Route Parameters

```javascript
app.get('/users/:id', (req, res) => {
    const id = req.params.id;
});

app.get('/files/:path(*)', (req, res) => {
    const path = req.params.path;
});
```

## Query Parameters

```javascript
app.get('/search', (req, res) => {
    const { q, page } = req.query;
});
```

## Route Handler

```javascript
function logRequest(req, res, next) {
    console.log(req.method, req.url);
    next();
}

app.get('/path', logRequest, (req, res) => {
    res.send('Done');
});
```
MD;
    }

    private function getExpressRoutingSolution(): string
    {
        return <<<'JS'
const express = require('express');
const app = express();

app.use(express.json());

// In-memory data
let users = [
    { id: 1, name: 'John', email: 'john@example.com' },
    { id: 2, name: 'Jane', email: 'jane@example.com' }
];

// GET all users
app.get('/api/users', (req, res) => {
    res.json(users);
});

// GET single user
app.get('/api/users/:id', (req, res) => {
    const user = users.find(u => u.id === parseInt(req.params.id));
    if (!user) return res.status(404).json({ error: 'User not found' });
    res.json(user);
});

// POST create user
app.post('/api/users', (req, res) => {
    const { name, email } = req.body;
    const newUser = { id: users.length + 1, name, email };
    users.push(newUser);
    res.status(201).json(newUser);
});

// PUT update user
app.put('/api/users/:id', (req, res) => {
    const user = users.find(u => u.id === parseInt(req.params.id));
    if (!user) return res.status(404).json({ error: 'User not found' });
    
    user.name = req.body.name || user.name;
    user.email = req.body.email || user.email;
    res.json(user);
});

// DELETE user
app.delete('/api/users/:id', (req, res) => {
    const index = users.findIndex(u => u.id === parseInt(req.params.id));
    if (index === -1) return res.status(404).json({ error: 'User not found' });
    
    const deleted = users.splice(index, 1);
    res.json(deleted[0]);
});

app.listen(3000, () => {
    console.log('Server running on port 3000');
});
JS;
    }

    private function getExpressMiddlewareContent(): string
    {
        return <<<'MD'
# Middleware

## What is Middleware?

Functions that have access to req, res, and next().

## Types

```javascript
// Application-level
app.use((req, res, next) => {
    console.log('Time:', Date.now());
    next();
});

// Route-level
app.use('/api', apiRouter);

// Built-in
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Third-party
const cors = require('cors');
app.use(cors());
```

## Custom Middleware

```javascript
function authMiddleware(req, res, next) {
    const token = req.headers.authorization;
    if (!token) {
        return res.status(401).json({ error: 'Unauthorized' });
    }
    next();
}

app.use('/protected', authMiddleware);
```

## Error Handling

```javascript
app.use((err, req, res, next) => {
    console.error(err.stack);
    res.status(500).json({ error: 'Something broke!' });
});
```
MD;
    }

    private function getExpressMiddlewareSolution(): string
    {
        return <<<'JS'
const express = require('express');
const app = express();

// Logger middleware
function logger(req, res, next) {
    console.log(`${new Date().toISOString()} - ${req.method} ${req.url}`);
    next();
}

app.use(logger);

// JSON parser
app.use(express.json());

// Auth middleware
function authMiddleware(req, res, next) {
    const token = req.headers['authorization'];
    
    if (!token || token !== 'secret-token') {
        return res.status(401).json({ error: 'Unauthorized' });
    }
    
    next();
}

// Public route
app.get('/', (req, res) => {
    res.json({ message: 'Public route' });
});

// Protected route
app.get('/api/protected', authMiddleware, (req, res) => {
    res.json({ message: 'Protected data', user: 'admin' });
});

// Error handling middleware
app.use((err, req, res, next) => {
    console.error('Error:', err.message);
    res.status(500).json({ error: 'Internal Server Error' });
});

// 404 handler
app.use((req, res) => {
    res.status(404).json({ error: 'Not Found' });
});

app.listen(3000, () => {
    console.log('Server running on port 3000');
});
JS;
    }

    private function getRESTPrinciplesContent(): string
    {
        return <<<'MD'
# REST API Principles

## What is REST?

Representational State Transfer - an architectural style for APIs.

## REST Constraints

1. **Client-Server** - Separation of concerns
2. **Stateless** - Each request contains all info
3. **Cacheable** - Responses can be cached
4. **Uniform Interface** - Consistent API design
5. **Layered System** - Client doesn't know if connected directly

## HTTP Methods

- `GET` - Retrieve resource
- `POST` - Create resource
- `PUT` - Update resource (replace)
- `PATCH` - Update resource (partial)
- `DELETE` - Delete resource

## Status Codes

- `200` OK
- `201` Created
- `204` No Content
- `400` Bad Request
- `401` Unauthorized
- `404` Not Found
- `500` Internal Server Error
MD;
    }

    private function getRESTPrinciplesSolution(): string
    {
        return <<<'JS'
const express = require('express');
const app = express();

app.use(express.json());

// Products data
let products = [
    { id: 1, name: 'Laptop', price: 999 },
    { id: 2, name: 'Mouse', price: 29 },
    { id: 3, name: 'Keyboard', price: 79 }
];

// GET all products
app.get('/api/products', (req, res) => {
    res.json(products);
});

// GET single product
app.get('/api/products/:id', (req, res) => {
    const product = products.find(p => p.id === parseInt(req.params.id));
    if (!product) {
        return res.status(404).json({ error: 'Product not found' });
    }
    res.json(product);
});

// POST create product
app.post('/api/products', (req, res) => {
    const { name, price } = req.body;
    
    if (!name || !price) {
        return res.status(400).json({ error: 'Name and price required' });
    }
    
    const newProduct = {
        id: products.length + 1,
        name,
        price: parseFloat(price)
    };
    
    products.push(newProduct);
    res.status(201).json(newProduct);
});

// PUT update product
app.put('/api/products/:id', (req, res) => {
    const product = products.find(p => p.id === parseInt(req.params.id));
    if (!product) {
        return res.status(404).json({ error: 'Product not found' });
    }
    
    product.name = req.body.name || product.name;
    product.price = req.body.price || product.price;
    res.json(product);
});

// DELETE product
app.delete('/api/products/:id', (req, res) => {
    const index = products.findIndex(p => p.id === parseInt(req.params.id));
    if (index === -1) {
        return res.status(404).json({ error: 'Product not found' });
    }
    
    const deleted = products.splice(index, 1);
    res.status(204).send();
});

app.listen(3000, () => {
    console.log('REST API running on port 3000');
});
JS;
    }

    private function getCRUDEndpointsContent(): string
    {
        return <<<'MD'
# Building CRUD Endpoints

## CRUD Operations

- **C**reate - POST
- **R**ead - GET
- **U**pdate - PUT/PATCH
- **D**elete - DELETE

## Example: Users API

```javascript
// GET /api/users - List all users
// GET /api/users/:id - Get single user
// POST /api/users - Create user
// PUT /api/users/:id - Update user
// DELETE /api/users/:id - Delete user
```

## Validation

```javascript
function validateUser(req, res, next) {
    const { name, email } = req.body;
    
    if (!name || !email) {
        return res.status(400).json({ 
            error: 'Name and email required' 
        });
    }
    
    next();
}

app.post('/api/users', validateUser, (req, res) => {});
```
MD;
    }

    private function getCRUDEndpointsSolution(): string
    {
        return <<<'JS'
const express = require('express');
const app = express();

app.use(express.json());

// Users data
let users = [];
let nextId = 1;

// Validation middleware
function validateUser(req, res, next) {
    const { name, email } = req.body;
    
    if (!name || name.length < 2) {
        return res.status(400).json({ error: 'Name must be at least 2 characters' });
    }
    
    if (!email || !email.includes('@')) {
        return res.status(400).json({ error: 'Valid email required' });
    }
    
    next();
}

// CREATE
app.post('/api/users', validateUser, (req, res) => {
    const { name, email, age } = req.body;
    
    const user = {
        id: nextId++,
        name,
        email,
        age: age || null,
        createdAt: new Date().toISOString()
    };
    
    users.push(user);
    res.status(201).json(user);
});

// READ all
app.get('/api/users', (req, res) => {
    res.json(users);
});

// READ one
app.get('/api/users/:id', (req, res) => {
    const user = users.find(u => u.id === parseInt(req.params.id));
    
    if (!user) {
        return res.status(404).json({ error: 'User not found' });
    }
    
    res.json(user);
});

// UPDATE
app.put('/api/users/:id', validateUser, (req, res) => {
    const user = users.find(u => u.id === parseInt(req.params.id));
    
    if (!user) {
        return res.status(404).json({ error: 'User not found' });
    }
    
    user.name = req.body.name;
    user.email = req.body.email;
    user.age = req.body.age || user.age;
    user.updatedAt = new Date().toISOString();
    
    res.json(user);
});

// DELETE
app.delete('/api/users/:id', (req, res) => {
    const index = users.findIndex(u => u.id === parseInt(req.params.id));
    
    if (index === -1) {
        return res.status(404).json({ error: 'User not found' });
    }
    
    const deleted = users.splice(index, 1);
    res.json({ message: 'User deleted', user: deleted[0] });
});

app.listen(3000, () => {
    console.log('CRUD API running on port 3000');
});
JS;
    }

    private function getJWTAuthContent(): string
    {
        return <<<'MD'
# JWT Authentication

## What is JWT?

JSON Web Token - a secure way to transmit information.

## Installation

```bash
npm install jsonwebtoken bcryptjs
```

## Token Structure

```
header.payload.signature
```

## Creating Tokens

```javascript
const jwt = require('jsonwebtoken');

const token = jwt.sign(
    { userId: 1, email: 'user@example.com' },
    'secret-key',
    { expiresIn: '1h' }
);
```

## Verifying Tokens

```javascript
const decoded = jwt.verify(token, 'secret-key');
```

## Middleware

```javascript
function authMiddleware(req, res, next) {
    const token = req.headers.authorization?.split(' ')[1];
    
    if (!token) {
        return res.status(401).json({ error: 'No token' });
    }
    
    try {
        req.user = jwt.verify(token, 'secret-key');
        next();
    } catch (err) {
        return res.status(401).json({ error: 'Invalid token' });
    }
}
```
MD;
    }

    private function getJWTAuthSolution(): string
    {
        return <<<'JS'
const express = require('express');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');

const app = express();
app.use(express.json());

const SECRET_KEY = 'your-secret-key-change-in-production';

// Users database
const users = [];

// Register
app.post('/api/register', async (req, res) => {
    try {
        const { name, email, password } = req.body;
        
        // Check if user exists
        if (users.find(u => u.email === email)) {
            return res.status(400).json({ error: 'User already exists' });
        }
        
        // Hash password
        const hashedPassword = await bcrypt.hash(password, 10);
        
        // Create user
        const user = {
            id: users.length + 1,
            name,
            email,
            password: hashedPassword
        };
        
        users.push(user);
        res.status(201).json({ message: 'User created' });
    } catch (err) {
        res.status(500).json({ error: 'Server error' });
    }
});

// Login
app.post('/api/login', async (req, res) => {
    try {
        const { email, password } = req.body;
        
        // Find user
        const user = users.find(u => u.email === email);
        if (!user) {
            return res.status(401).json({ error: 'Invalid credentials' });
        }
        
        // Check password
        const valid = await bcrypt.compare(password, user.password);
        if (!valid) {
            return res.status(401).json({ error: 'Invalid credentials' });
        }
        
        // Create token
        const token = jwt.sign(
            { userId: user.id, email: user.email },
            SECRET_KEY,
            { expiresIn: '24h' }
        );
        
        res.json({ token, user: { id: user.id, name: user.name, email: user.email } });
    } catch (err) {
        res.status(500).json({ error: 'Server error' });
    }
});

// Auth middleware
function authMiddleware(req, res, next) {
    const authHeader = req.headers.authorization;
    
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
        return res.status(401).json({ error: 'No token provided' });
    }
    
    const token = authHeader.split(' ')[1];
    
    try {
        req.user = jwt.verify(token, SECRET_KEY);
        next();
    } catch (err) {
        return res.status(401).json({ error: 'Invalid token' });
    }
}

// Protected route
app.get('/api/profile', authMiddleware, (req, res) => {
    res.json({ 
        message: 'Protected data',
        user: req.user 
    });
});

app.listen(3000, () => {
    console.log('Auth API running on port 3000');
});
JS;
    }

    // React Content Methods
    private function getReactIntroContent(): string
    {
        return <<<'MD'
# Introduction to React

## What is React?

React is a JavaScript library for building user interfaces, created by Facebook.

## Why React?

- **Component-Based** - Reusable UI components
- **Declarative** - Describe what you want, React handles how
- **Virtual DOM** - Efficient updates
- **Large Ecosystem** - Tons of libraries and tools

## JSX

```javascript
const element = <h1>Hello, React!</h1>;
```

## Components

```javascript
// Functional component
function Welcome(props) {
    return <h1>Hello, {props.name}</h1>;
}

// Using component
<Welcome name="John" />
```
MD;
    }

    private function getReactIntroSolution(): string
    {
        return <<<'JSX'
import React from 'react';

// Simple functional component
function Greeting() {
    return (
        <div>
            <h1>Hello, React!</h1>
            <p>Welcome to React development</p>
        </div>
    );
}

// Component with props
function Welcome(props) {
    return <h1>Hello, {props.name}!</h1>;
}

// Using the component
function App() {
    return (
        <div>
            <Greeting />
            <Welcome name="John" />
            <Welcome name="Jane" />
        </div>
    );
}

export default App;
JSX;
    }

    private function getReactSetupContent(): string
    {
        return <<<'MD'
# Setting Up React Environment

## Using Vite (Recommended)

```bash
# Create project
npm create vite@latest my-app -- --template react

# Install dependencies
cd my-app
npm install

# Run development server
npm run dev
```

## Project Structure

```
my-app/
├── public/
├── src/
│   ├── App.jsx
│   ├── main.jsx
│   ├── components/
│   └── assets/
├── package.json
└── vite.config.js
```

## First Component

```javascript
function App() {
    return (
        <div>
            <h1>Hello React!</h1>
        </div>
    );
}

export default App;
```
MD;
    }

    private function getReactComponentsContent(): string
    {
        return <<<'MD'
# Understanding Components

## Functional Components

```javascript
function Welcome(props) {
    return <h1>Hello, {props.name}</h1>;
}
```

## Arrow Function Components

```javascript
const Welcome = (props) => {
    return <h1>Hello, {props.name}</h1>;
};
```

## Component Composition

```javascript
function App() {
    return (
        <div>
            <Header />
            <Main />
            <Footer />
        </div>
    );
}
```

## Props

```javascript
function UserCard({ name, age, email }) {
    return (
        <div>
            <h2>{name}</h2>
            <p>Age: {age}</p>
            <p>Email: {email}</p>
        </div>
    );
}
```
MD;
    }

    private function getReactComponentsSolution(): string
    {
        return <<<'JSX'
import React from 'react';

// Basic functional component
function Header() {
    return <header><h1>My Website</h1></header>;
}

// Component with props
function UserCard({ name, age, email }) {
    return (
        <div className="user-card">
            <h2>{name}</h2>
            <p>Age: {age}</p>
            <p>Email: {email}</p>
        </div>
    );
}

// Component with default props
function Greeting({ name = 'Guest' }) {
    return <p>Hello, {name}!</p>;
}

// Component composition
function App() {
    return (
        <div>
            <Header />
            <main>
                <UserCard name="John" age={30} email="john@example.com" />
                <UserCard name="Jane" age={25} email="jane@example.com" />
                <Greeting />
                <Greeting name="Developer" />
            </main>
        </div>
    );
}

export default App;
JSX;
    }

    private function getReactPropsContent(): string
    {
        return <<<'MD'
# Working with Props

## Passing Props

```javascript
<Welcome name="John" age={30} />
```

## Destructuring Props

```javascript
function Welcome({ name, age }) {
    return <h1>{name}, {age}</h1>;
}
```

## Children Prop

```javascript
function Card({ children }) {
    return <div className="card">{children}</div>;
}

// Usage
<Card>
    <h2>Title</h2>
    <p>Content</p>
</Card>
```

## Default Props

```javascript
function Button({ label = 'Click', onClick }) {
    return <button onClick={onClick}>{label}</button>;
}
```
MD;
    }

    private function getReactPropsSolution(): string
    {
        return <<<'JSX'
import React from 'react';

// Product component with props
function Product({ name, price, description, inStock = true }) {
    return (
        <div className="product">
            <h3>{name}</h3>
            <p>{description}</p>
            <p className="price">${price}</p>
            {inStock ? (
                <button>Add to Cart</button>
            ) : (
                <span>Out of Stock</span>
            )}
        </div>
    );
}

// List component with children
function Card({ title, children }) {
    return (
        <div className="card">
            <h2>{title}</h2>
            <div className="content">{children}</div>
        </div>
    );
}

// App component
function App() {
    return (
        <div>
            <Card title="Products">
                <Product 
                    name="Laptop" 
                    price={999} 
                    description="Powerful laptop"
                />
                <Product 
                    name="Mouse" 
                    price={29} 
                    description="Wireless mouse"
                    inStock={false}
                />
            </Card>
        </div>
    );
}

export default App;
JSX;
    }

    private function getReactStateContent(): string
    {
        return <<<'MD'
# Introduction to State

## useState Hook

```javascript
import { useState } from 'react';

function Counter() {
    const [count, setCount] = useState(0);
    
    return (
        <div>
            <p>Count: {count}</p>
            <button onClick={() => setCount(count + 1)}>
                Increment
            </button>
        </div>
    );
}
```

## State Rules

1. Only call hooks at the top level
2. Only call hooks from React functions
3. State updates are asynchronous

## Multiple State Variables

```javascript
const [name, setName] = useState('');
const [age, setAge] = useState(0);
const [items, setItems] = useState([]);
```

## State with Objects

```javascript
const [user, setUser] = useState({
    name: '',
    email: ''
});

// Update
setUser({ ...user, name: 'New Name' });
```
MD;
    }

    private function getReactStateSolution(): string
    {
        return <<<'JSX'
import React, { useState } from 'react';

// Counter component
function Counter() {
    const [count, setCount] = useState(0);
    
    return (
        <div>
            <p>Count: {count}</p>
            <button onClick={() => setCount(count + 1)}>
                Increment
            </button>
            <button onClick={() => setCount(count - 1)}>
                Decrement
            </button>
            <button onClick={() => setCount(0)}>
                Reset
            </button>
        </div>
    );
}

// Form with multiple state
function UserForm() {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [submitted, setSubmitted] = useState(false);
    
    const handleSubmit = (e) => {
        e.preventDefault();
        setSubmitted(true);
    };
    
    return (
        <div>
            {submitted ? (
                <p>Thank you, {name}!</p>
            ) : (
                <form onSubmit={handleSubmit}>
                    <input
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                        placeholder="Name"
                    />
                    <input
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        placeholder="Email"
                    />
                    <button type="submit">Submit</button>
                </form>
            )}
        </div>
    );
}

export default function App() {
    return (
        <div>
            <Counter />
            <UserForm />
        </div>
    );
}
JSX;
    }

    private function getReactEventsContent(): string
    {
        return <<<'MD'
# Handling Events

## Event Handlers

```javascript
function Button() {
    const handleClick = () => {
        console.log('Clicked!');
    };
    
    return <button onClick={handleClick}>Click</button>;
}
```

## Event Object

```javascript
function Input() {
    const handleChange = (e) => {
        console.log(e.target.value);
    };
    
    return <input onChange={handleChange} />;
}
```

## Form Submission

```javascript
function Form() {
    const handleSubmit = (e) => {
        e.preventDefault();
        // Handle submit
    };
    
    return <form onSubmit={handleSubmit}>...</form>;
}
```

## Passing Arguments

```javascript
function List() {
    const handleDelete = (id) => {
        console.log('Delete', id);
    };
    
    return (
        <button onClick={() => handleDelete(item.id)}>
            Delete
        </button>
    );
}
```
MD;
    }

    private function getReactEventsSolution(): string
    {
        return <<<'JSX'
import React, { useState } from 'react';

// Todo list with events
function TodoList() {
    const [todos, setTodos] = useState([]);
    const [input, setInput] = useState('');
    
    const handleAdd = () => {
        if (input.trim()) {
            setTodos([...todos, { id: Date.now(), text: input }]);
            setInput('');
        }
    };
    
    const handleDelete = (id) => {
        setTodos(todos.filter(todo => todo.id !== id));
    };
    
    const handleKeyPress = (e) => {
        if (e.key === 'Enter') {
            handleAdd();
        }
    };
    
    return (
        <div>
            <input
                value={input}
                onChange={(e) => setInput(e.target.value)}
                onKeyPress={handleKeyPress}
                placeholder="Add todo"
            />
            <button onClick={handleAdd}>Add</button>
            
            <ul>
                {todos.map(todo => (
                    <li key={todo.id}>
                        {todo.text}
                        <button onClick={() => handleDelete(todo.id)}>
                            Delete
                        </button>
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default TodoList;
JSX;
    }

    // Laravel Content Methods
    private function getLaravelIntroContent(): string
    {
        return <<<'MD'
# What is Laravel?

## Introduction

Laravel is a PHP web application framework with expressive, elegant syntax.

## Why Laravel?

- **Elegant Syntax** - Clean, readable code
- **Eloquent ORM** - Beautiful database abstraction
- **Blade Templating** - Powerful template engine
- **Artisan CLI** - Command-line tool
- **Built-in Features** - Auth, routing, sessions, caching

## Installation

```bash
composer create-project laravel/laravel my-app
cd my-app
php artisan serve
```

## Directory Structure

```
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
database/
├── migrations/
├── seeders/
routes/
└── web.php
```
MD;
    }

    private function getLaravelStructureContent(): string
    {
        return <<<'MD'
# Laravel Directory Structure

## Key Directories

### app/
- `Http/Controllers` - Request handling logic
- `Models` - Database models
- `Providers` - Service providers

### database/
- `migrations` - Database migrations
- `seeders` - Database seeders
- `factories` - Model factories

### routes/
- `web.php` - Web routes
- `api.php` - API routes

### resources/
- `views` - Blade templates
- `css` - Stylesheets
- `js` - JavaScript files

## Artisan Commands

```bash
php artisan make:controller HomeController
php artisan make:model Post
php artisan make:migration create_posts_table
php artisan make:middleware CheckAge
```
MD;
    }

    private function getLaravelRoutingContent(): string
    {
        return <<<'MD'
# Basic Routing

## Basic Routes

```php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return 'About Page';
});
```

## Route Parameters

```php
Route::get('/user/{id}', function ($id) {
    return 'User ' . $id;
});

Route::get('/post/{slug}', function ($slug) {
    //
});
```

## Named Routes

```php
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// Usage
redirect()->route('profile');
```

## Route Groups

```php
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {});
});
```
MD;
    }

    private function getLaravelRoutingSolution(): string
    {
        return <<<'PHP'
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

// Basic route
Route::get('/', function () {
    return view('welcome');
});

// About page
Route::get('/about', function () {
    return view('about');
});

// Route with parameter
Route::get('/user/{id}', function ($id) {
    return 'User ' . $id;
})->whereNumber('id');

// Named route
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Route group with prefix
Route::prefix('api')->group(function () {
    Route::get('/users', function () {
        return response()->json(['users' => []]);
    });
});

// Resource controller routes
Route::resource('posts', PostController::class);

// Route with middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
PHP;
    }

    private function getLaravelControllersContent(): string
    {
        return <<<'MD'
# Creating Controllers

## Make Controller

```bash
php artisan make:controller PostController
```

## Controller Methods

```php
class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }
    
    public function show($id)
    {
        return view('posts.show', ['id' => $id]);
    }
}
```

## Resource Controller

```bash
php artisan make:controller PostController --resource
```

Generates:
- index, create, store, show, edit, update, destroy

## Route to Controller

```php
Route::get('/posts', [PostController::class, 'index']);
Route::resource('posts', PostController::class);
```
MD;
    }

    private function getLaravelControllersSolution(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display all posts
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'Post 1'],
            ['id' => 2, 'title' => 'Post 2'],
        ];
        
        return view('posts.index', compact('posts'));
    }
    
    // Show create form
    public function create()
    {
        return view('posts.create');
    }
    
    // Store new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        
        // Create post
        return redirect()->route('posts.index');
    }
    
    // Show single post
    public function show($id)
    {
        $post = ['id' => $id, 'title' => 'Post ' . $id];
        return view('posts.show', compact('post'));
    }
    
    // Show edit form
    public function edit($id)
    {
        return view('posts.edit', ['id' => $id]);
    }
    
    // Update post
    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('posts.show', $id);
    }
    
    // Delete post
    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('posts.index');
    }
}
PHP;
    }

    private function getEloquentContent(): string
    {
        return <<<'MD'
# Introduction to Eloquent

## What is Eloquent?

Eloquent is Laravel's ORM (Object-Relational Mapping) system.

## Creating Models

```bash
php artisan make:model Post
```

## Basic Usage

```php
// Get all posts
$posts = Post::all();

// Find by ID
$post = Post::find(1);

// Find by column
$post = Post::where('status', 'published')->first();

// Create
$post = new Post;
$post->title = 'New Post';
$post->save();

// Update
$post->update(['title' => 'Updated']);

// Delete
$post->delete();
```

## Migrations

```bash
php artisan make:migration create_posts_table
```
MD;
    }

    private function getEloquentSolution(): string
    {
        return <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Fillable attributes
    protected $fillable = [
        'title',
        'content',
        'status',
    ];
    
    // Hidden attributes
    protected $hidden = [
        'password',
    ];
    
    // Cast attributes
    protected $casts = [
        'published_at' => 'datetime',
    ];
    
    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

// Usage examples:
// $posts = Post::published()->get();
// $post = Post::with('user', 'comments')->find(1);
PHP;
    }

    private function getEloquentRelationshipsContent(): string
    {
        return <<<'MD'
# Eloquent Relationships

## One to One

```php
class User extends Model
{
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
```

## One to Many

```php
class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
```

## Many to Many

```php
class User extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
```

## Belongs To

```php
class Comment extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
```

## Usage

```php
// Get comments
$post->comments;

// Add comment
$post->comments()->create(['text' => 'Nice!']);

// Get post of comment
$comment->post;
```
MD;
    }

    private function getEloquentRelationshipsSolution(): string
    {
        return <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // One to Many - User has many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    // One to Many - User has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

class Post extends Model
{
    // Belongs To - Post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // One to Many - Post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    // Many to Many - Post has many tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

class Comment extends Model
{
    // Belongs To - Comment belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    // Belongs To - Comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// Usage:
// Get user's posts: $user->posts
// Get post's user: $post->user
// Get post's comments: $post->comments
// Get comment's post: $comment->post
// Attach tags: $post->tags()->attach($tagId);
PHP;
    }
}
