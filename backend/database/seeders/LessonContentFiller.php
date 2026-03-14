<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonContentFiller extends Seeder
{
    public function run(): void
    {
        // HTML & CSS Course Lessons
        $this->updateLesson('how-the-web-works', $this->howWebWorks());
        $this->updateLesson('html-document-structure', $this->htmlStructure());
        $this->updateLesson('working-with-text-elements', $this->textElements());
        $this->updateLesson('links-images-media', $this->linksImages());
        $this->updateLesson('css-syntax-selectors', $this->cssSyntax());
        $this->updateLesson('the-box-model-explained', $this->boxModel());
        $this->updateLesson('flexbox-fundamentals', $this->flexbox());
        
        // JavaScript Course Lessons
        $this->updateLesson('intro-to-javascript', $this->introJS());
        $this->updateLesson('variables-data-types', $this->variables());
        $this->updateLesson('conditional-statements', $this->conditionals());
        $this->updateLesson('loops-for-while', $this->loops());
        $this->updateLesson('function-declarations', $this->functions());
        $this->updateLesson('arrays-and-array-methods', $this->arrays());
        $this->updateLesson('intro-to-dom', $this->dom());
        $this->updateLesson('promises', $this->promises());
        $this->updateLesson('async-await', $this->asyncAwait());
        
        // Node.js Course Lessons
        $this->updateLesson('what-is-nodejs', $this->whatIsNodeJS());
        $this->updateLesson('fs-module', $this->fsModule());
        $this->updateLesson('http-module', $this->httpModule());
        $this->updateLesson('intro-to-express', $this->introExpress());
        $this->updateLesson('express-routing', $this->expressRouting());
        $this->updateLesson('rest-api-principles', $this->restPrinciples());
        $this->updateLesson('crud-endpoints', $this->crudEndpoints());
        $this->updateLesson('jwt-authentication', $this->jwtAuth());
        
        echo "Lesson content updated successfully!\n";
    }
    
    private function updateLesson($lessonSlug, $data)
    {
        $updated = Lesson::where('slug', 'like', "%{$lessonSlug}%")->update($data);
        if ($updated) {
            echo "Updated: {$lessonSlug}\n";
        }
    }
    
    private function howWebWorks(): array
    {
        return [
            'content_html' => "# How the Web Works\n\n## Client-Server Model\n\nThe web works on a client-server model where clients (browsers) request resources from servers.\n\n```\nClient (Browser) --> HTTP Request --> Server\nClient (Browser) <-- HTTP Response <-- Server\n```\n\n## HTTP/HTTPS\n\n- **HTTP** - HyperText Transfer Protocol\n- **HTTPS** - Secure version with encryption\n\n## Key Takeaways\n\n1. Web uses client-server architecture\n2. HTTP is the communication protocol\n3. DNS translates domains to IPs",
            'programming_language' => 'html',
            'exercise_description' => 'Buat HTML file sederhana dengan DOCTYPE, html, head, dan body.',
            'starter_code' => '<!-- Buat struktur HTML di sini -->\n\n',
            'solution_code' => '<!DOCTYPE html>\n<html lang="en">\n<head>\n    <meta charset="UTF-8">\n    <title>My Page</title>\n</head>\n<body>\n    <h1>Hello World!</h1>\n</body>\n</html>',
        ];
    }
    
    private function htmlStructure(): array
    {
        return [
            'content_html' => "# HTML Document Structure\n\n## Basic Structure\n\n```html\n<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n    <meta charset=\"UTF-8\">\n    <title>Page Title</title>\n</head>\n<body>\n    Content\n</body>\n</html>\n```\n\n## Semantic Elements\n\n- `<header>` - Header section\n- `<nav>` - Navigation\n- `<main>` - Main content\n- `<footer>` - Footer section",
            'programming_language' => 'html',
            'exercise_description' => 'Buat HTML dengan semantic elements.',
            'starter_code' => '<!DOCTYPE html>\n<html>\n\n</html>',
            'solution_code' => '<!DOCTYPE html>\n<html lang="en">\n<head>\n    <meta charset="UTF-8">\n    <title>Semantic Page</title>\n</head>\n<body>\n    <header><h1>Website</h1></header>\n    <nav>Navigation</nav>\n    <main>Content</main>\n    <footer>Footer</footer>\n</body>\n</html>',
        ];
    }
    
    private function textElements(): array
    {
        return [
            'content_html' => "# Text Elements\n\n## Headings\n\n```html\n<h1>Main Heading</h1>\n<h2>Section</h2>\n<h3>Subsection</h3>\n```\n\n## Text Formatting\n\n- `<strong>` - Bold\n- `<em>` - Italic\n- `<mark>` - Highlight\n\n## Lists\n\n```html\n<ul>\n    <li>Item 1</li>\n    <li>Item 2</li>\n</ul>\n```",
            'programming_language' => 'html',
            'exercise_description' => 'Buat artikel dengan heading, paragraph, dan list.',
            'starter_code' => '<article>\n    \n</article>',
            'solution_code' => '<article>\n    <h1>Blog Post</h1>\n    <p>Introduction paragraph.</p>\n    <h2>Points</h2>\n    <ul>\n        <li>Point 1</li>\n        <li>Point 2</li>\n    </ul>\n</article>',
        ];
    }
    
    private function linksImages(): array
    {
        return [
            'content_html' => "# Links and Images\n\n## Links\n\n```html\n<a href=\"https://example.com\">Link</a>\n<a href=\"/about\">Internal</a>\n<a href=\"mailto:test@example.com\">Email</a>\n```\n\n## Images\n\n```html\n<img src=\"image.jpg\" alt=\"Description\" width=\"800\">\n```\n\n## Best Practices\n\n- Always include alt text\n- Use loading=\"lazy\" for performance",
            'programming_language' => 'html',
            'exercise_description' => 'Buat halaman dengan links dan images.',
            'starter_code' => '<!DOCTYPE html>\n<html>\n<body>\n    \n</body>\n</html>',
            'solution_code' => '<!DOCTYPE html>\n<html>\n<body>\n    <nav>\n        <a href="#home">Home</a>\n        <a href="#about">About</a>\n    </nav>\n    <img src="photo.jpg" alt="Photo" width="400">\n</body>\n</html>',
        ];
    }
    
    private function cssSyntax(): array
    {
        return [
            'content_html' => "# CSS Syntax\n\n## Basic Syntax\n\n```css\nselector {\n    property: value;\n}\n```\n\n## Selectors\n\n- Element: `p { }`\n- Class: `.classname { }`\n- ID: `#idname { }`\n- Attribute: `input[type=\"text\"] { }`\n\n## Pseudo-classes\n\n```css\na:hover { color: red; }\nli:first-child { font-weight: bold; }\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Buat CSS dengan berbagai selectors.',
            'starter_code' => '/* CSS Selectors */\n\n',
            'solution_code' => '/* Element */\nbody { font-family: Arial; }\n\n/* Class */\n.container { max-width: 1200px; }\n\n/* ID */\n#header { background: #333; }\n\n/* Pseudo-class */\na:hover { color: blue; }',
        ];
    }
    
    private function boxModel(): array
    {
        return [
            'content_html' => "# The Box Model\n\n## Components\n\n```\n┌─ Margin ─────────────────┐\n│  ┌─ Border ────────────┐ │\n│  │  ┌─ Padding ──────┐ │ │\n│  │  │   Content      │ │ │\n│  │  └────────────────┘ │ │\n│  └─────────────────────┘ │\n└──────────────────────────┘\n```\n\n## CSS\n\n```css\n.box {\n    margin: 20px;\n    border: 1px solid #333;\n    padding: 15px;\n}\n```\n\n## Box Sizing\n\n```css\n* { box-sizing: border-box; }\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Demonstrasikan box model dengan card.',
            'starter_code' => '.card {\n    \n}',
            'solution_code' => '.card {\n    width: 300px;\n    margin: 20px;\n    padding: 20px;\n    border: 2px solid #3498db;\n    background: #f4f4f4;\n}',
        ];
    }
    
    private function flexbox(): array
    {
        return [
            'content_html' => "# Flexbox\n\n## Container Properties\n\n```css\n.container {\n    display: flex;\n    justify-content: center;\n    align-items: center;\n    gap: 20px;\n}\n```\n\n## Item Properties\n\n```css\n.item {\n    flex: 1;\n    align-self: stretch;\n}\n```\n\n## Common Patterns\n\n- Center: `justify-content: center; align-items: center;`\n- Space between: `justify-content: space-between;`\n- Column: `flex-direction: column;`",
            'programming_language' => 'css',
            'exercise_description' => 'Buat navbar dengan Flexbox.',
            'starter_code' => '.navbar {\n    display: flex;\n}',
            'solution_code' => '.navbar {\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n    padding: 15px 30px;\n    background: #2c3e50;\n}\n\n.nav-links {\n    display: flex;\n    gap: 20px;\n    list-style: none;\n}',
        ];
    }
    
    private function introJS(): array
    {
        return [
            'content_html' => "# Introduction to JavaScript\n\n## What is JavaScript?\n\nJavaScript is a programming language that adds interactivity to websites.\n\n## Basic Syntax\n\n```javascript\n// Comment\nlet name = 'John';\nconst age = 25;\n\nconsole.log('Hello, ' + name);\n```\n\n## Data Types\n\n- String: `'Hello'`\n- Number: `42`\n- Boolean: `true`\n- Object: `{}`\n- Array: `[]`",
            'programming_language' => 'javascript',
            'exercise_description' => 'Print \"Hello, World!\" ke console.',
            'starter_code' => '// Tulis kode JavaScript di sini\n\n',
            'solution_code' => '// Hello World\nconsole.log("Hello, World!");\n\n// Variables\nlet name = "Developer";\nconsole.log("Hello, " + name + "!");',
            'test_cases' => [['input' => '', 'expected_output' => 'Hello, World!']],
        ];
    }
    
    private function variables(): array
    {
        return [
            'content_html' => "# Variables and Data Types\n\n## Declarations\n\n```javascript\nlet count = 0;      // Reassignable\nconst PI = 3.14;    // Constant\nvar old = 'legacy'; // Avoid\n```\n\n## Data Types\n\n```javascript\n// Primitive\nconst text = 'Hello';\nconst num = 42;\nconst bool = true;\nconst nothing = null;\nlet undefined;\n\n// Reference\nconst obj = { key: 'value' };\nconst arr = [1, 2, 3];\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Deklarasikan variabel dengan berbagai tipe data.',
            'starter_code' => '// Deklarasikan variabel\n\n',
            'solution_code' => 'const greeting = "Hello!";\nlet age = 25;\nconst pi = 3.14;\nconst isLearning = true;\nconst hobbies = ["coding", "reading"];\nconst person = { name: "John", age: 30 };\n\nconsole.log(greeting);\nconsole.log("Age:", age);\nconsole.log("Hobbies:", hobbies);\nconsole.log("Person:", person);',
        ];
    }
    
    private function conditionals(): array
    {
        return [
            'content_html' => "# Conditional Statements\n\n## if/else\n\n```javascript\nlet age = 18;\n\nif (age >= 18) {\n    console.log('Adult');\n} else {\n    console.log('Minor');\n}\n```\n\n## Ternary\n\n```javascript\nconst status = (age >= 18) ? 'Adult' : 'Minor';\n```\n\n## Switch\n\n```javascript\nswitch(day) {\n    case 'Monday':\n        console.log('Start');\n        break;\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Buat fungsi untuk menentukan grade dari nilai.',
            'starter_code' => 'function getGrade(score) {\n    \n}\n\nconsole.log(getGrade(85));',
            'solution_code' => 'function getGrade(score) {\n    if (score >= 90) return "A";\n    else if (score >= 80) return "B";\n    else if (score >= 70) return "C";\n    else return "F";\n}\n\nconsole.log("Grade:", getGrade(85)); // B',
        ];
    }
    
    private function loops(): array
    {
        return [
            'content_html' => "# Loops\n\n## for Loop\n\n```javascript\nfor (let i = 0; i < 5; i++) {\n    console.log(i);\n}\n```\n\n## while Loop\n\n```javascript\nlet i = 0;\nwhile (i < 5) {\n    console.log(i);\n    i++;\n}\n```\n\n## for...of\n\n```javascript\nfor (const item of array) {\n    console.log(item);\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Cetak angka 1-10 dan hitung totalnya.',
            'starter_code' => 'let sum = 0;\n\n',
            'solution_code' => 'let sum = 0;\n\nfor (let i = 1; i <= 10; i++) {\n    console.log(i);\n    sum += i;\n}\n\nconsole.log("Total:", sum);',
        ];
    }
    
    private function functions(): array
    {
        return [
            'content_html' => "# Functions\n\n## Declaration\n\n```javascript\nfunction greet(name) {\n    return 'Hello, ' + name;\n}\n```\n\n## Arrow Function\n\n```javascript\nconst greet = (name) => 'Hello, ' + name;\n```\n\n## Default Parameters\n\n```javascript\nfunction greet(name) {\n    return 'Hello, ' + (name || 'Guest');\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Buat fungsi untuk operasi matematika.',
            'starter_code' => 'function add(a, b) {\n    \n}\n\n',
            'solution_code' => 'function add(a, b) {\n    return a + b;\n}\n\nconst subtract = (a, b) => a - b;\n\nfunction multiply(a, b) {\n    return a * b;\n}\n\nconsole.log("Add:", add(5, 3));\nconsole.log("Subtract:", subtract(10, 4));\nconsole.log("Multiply:", multiply(6, 7));',
        ];
    }
    
    private function arrays(): array
    {
        return [
            'content_html' => "# Arrays\n\n## Array Methods\n\n```javascript\n// map - transform\nconst doubled = [1, 2, 3].map(x => x * 2);\n\n// filter\nconst evens = [1, 2, 3, 4].filter(x => x % 2 === 0);\n\n// reduce\nconst sum = [1, 2, 3].reduce((acc, x) => acc + x, 0);\n\n// forEach\n[1, 2, 3].forEach(x => console.log(x));\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Manipulasi array dengan map, filter, reduce.',
            'starter_code' => 'const numbers = [1, 2, 3, 4, 5];\n\n',
            'solution_code' => 'const numbers = [1, 2, 3, 4, 5];\n\nconst doubled = numbers.map(n => n * 2);\nconsole.log("Doubled:", doubled);\n\nconst evens = numbers.filter(n => n % 2 === 0);\nconsole.log("Evens:", evens);\n\nconst sum = numbers.reduce((acc, n) => acc + n, 0);\nconsole.log("Sum:", sum);',
        ];
    }
    
    private function dom(): array
    {
        return [
            'content_html' => "# DOM Manipulation\n\n## Selecting Elements\n\n```javascript\ndocument.getElementById('id');\ndocument.querySelector('.class');\ndocument.querySelectorAll('div');\n```\n\n## Manipulating\n\n```javascript\nelement.textContent = 'New text';\nelement.style.color = 'red';\nelement.classList.add('active');\n```\n\n## Creating Elements\n\n```javascript\nconst div = document.createElement('div');\ndocument.body.appendChild(div);\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Manipulasi DOM (berjalan di browser).',
            'starter_code' => '// DOM manipulation code\n// Runs in browser\n\n',
            'solution_code' => '// Select element\nconst heading = document.querySelector("h1");\n\n// Change content\nheading.textContent = "New Heading!";\n\n// Change style\nheading.style.color = "blue";\nheading.style.fontSize = "36px";\n\n// Create element\nconst p = document.createElement("p");\np.textContent = "New paragraph";\ndocument.body.appendChild(p);',
        ];
    }
    
    private function promises(): array
    {
        return [
            'content_html' => "# Promises\n\n## Creating Promises\n\n```javascript\nconst promise = new Promise((resolve, reject) => {\n    setTimeout(() => {\n        resolve('Success!');\n    }, 1000);\n});\n```\n\n## Using Promises\n\n```javascript\npromise\n    .then(result => console.log(result))\n    .catch(error => console.error(error));\n```\n\n## Chaining\n\n```javascript\nfetch('/api/data')\n    .then(res => res.json())\n    .then(data => console.log(data));\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Buat Promise untuk simulasi async operation.',
            'starter_code' => 'const myPromise = new Promise((resolve, reject) => {\n    \n});\n\n',
            'solution_code' => 'const myPromise = new Promise((resolve, reject) => {\n    setTimeout(() => {\n        resolve("Operation completed!");\n    }, 1000);\n});\n\nmyPromise\n    .then(result => console.log("Success:", result))\n    .catch(error => console.error("Error:", error))\n    .finally(() => console.log("Done"));',
        ];
    }
    
    private function asyncAwait(): array
    {
        return [
            'content_html' => "# Async/Await\n\n## Async Functions\n\n```javascript\nasync function fetchData() {\n    return 'data';\n}\n```\n\n## Await\n\n```javascript\nasync function getData() {\n    const result = await fetchData();\n    console.log(result);\n}\n```\n\n## Error Handling\n\n```javascript\ntry {\n    const data = await fetchData();\n} catch (error) {\n    console.error(error);\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Konversi Promise code ke async/await.',
            'starter_code' => 'async function getData() {\n    \n}\n\n',
            'solution_code' => 'async function fetchData() {\n    return new Promise(resolve => {\n        setTimeout(() => resolve({ id: 1, name: "John" }), 1000);\n    });\n}\n\nasync function getData() {\n    try {\n        const data = await fetchData();\n        console.log("Data:", data);\n    } catch (error) {\n        console.error("Error:", error);\n    }\n}\n\ngetData();',
        ];
    }
    
    private function whatIsNodeJS(): array
    {
        return [
            'content_html' => "# What is Node.js?\n\n## Introduction\n\nNode.js is a JavaScript runtime built on Chrome's V8 engine.\n\n## Why Node.js?\n\n- JavaScript everywhere (frontend + backend)\n- Fast and efficient (non-blocking I/O)\n- Large ecosystem (NPM packages)\n- Great for real-time apps\n\n## Your First Node.js Program\n\n```javascript\nconsole.log('Hello from Node.js!');\nconsole.log('Version:', process.version);\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Print informasi Node.js environment.',
            'starter_code' => '// Node.js code\n\n',
            'solution_code' => 'console.log("Hello from Node.js!");\nconsole.log("Version:", process.version);\nconsole.log("Platform:", process.platform);\nconsole.log("Architecture:", process.arch);\nconsole.log("Current directory:", process.cwd());',
            'test_cases' => [['input' => '', 'expected_output' => 'Hello from Node.js!']],
        ];
    }
    
    private function fsModule(): array
    {
        return [
            'content_html' => "# File System Module\n\n## Reading Files\n\n```javascript\nconst fs = require('fs');\n\n// Synchronous\nconst data = fs.readFileSync('file.txt', 'utf8');\n\n// Asynchronous\nfs.readFile('file.txt', 'utf8', (err, data) => {\n    console.log(data);\n});\n```\n\n## Writing Files\n\n```javascript\nfs.writeFileSync('file.txt', 'Hello');\nfs.writeFile('file.txt', 'Hello', (err) => {});\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Baca dan tulis file dengan fs module.',
            'starter_code' => 'const fs = require("fs");\n\n',
            'solution_code' => 'const fs = require("fs");\n\n// Write file\nfs.writeFileSync("example.txt", "Hello Node.js!");\nconsole.log("File written!");\n\n// Read file\nconst content = fs.readFileSync("example.txt", "utf8");\nconsole.log("Content:", content);',
        ];
    }
    
    private function httpModule(): array
    {
        return [
            'content_html' => "# HTTP Module\n\n## Creating Server\n\n```javascript\nconst http = require('http');\n\nconst server = http.createServer((req, res) => {\n    res.writeHead(200, { 'Content-Type': 'text/plain' });\n    res.end('Hello World');\n});\n\nserver.listen(3000, () => {\n    console.log('Server running at http://localhost:3000');\n});\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Buat HTTP server sederhana.',
            'starter_code' => 'const http = require("http");\n\n',
            'solution_code' => 'const http = require("http");\n\nconst server = http.createServer((req, res) => {\n    res.writeHead(200, { "Content-Type": "application/json" });\n    res.end(JSON.stringify({ message: "Hello World!" }));\n});\n\nserver.listen(3000, () => {\n    console.log("Server running at http://localhost:3000");\n});',
        ];
    }
    
    private function introExpress(): array
    {
        return [
            'content_html' => "# Introduction to Express\n\n## Basic Server\n\n```javascript\nconst express = require('express');\nconst app = express();\n\napp.get('/', (req, res) => {\n    res.send('Hello World!');\n});\n\napp.listen(3000, () => {\n    console.log('Server running on port 3000');\n});\n```\n\n## Response Methods\n\n- `res.send()` - Send response\n- `res.json()` - Send JSON\n- `res.status()` - Set status code",
            'programming_language' => 'javascript',
            'exercise_description' => 'Buat Express server dengan route dasar.',
            'starter_code' => 'const express = require("express");\nconst app = express();\n\n',
            'solution_code' => 'const express = require("express");\nconst app = express();\n\napp.get("/", (req, res) => {\n    res.json({ message: "Welcome!" });\n});\n\napp.get("/about", (req, res) => {\n    res.send("About page");\n});\n\napp.listen(3000, () => {\n    console.log("Server running on port 3000");\n});',
        ];
    }
    
    private function expressRouting(): array
    {
        return [
            'content_html' => "# Express Routing\n\n## Basic Routes\n\n```javascript\napp.get('/path', (req, res) => {});\napp.post('/path', (req, res) => {});\napp.put('/path', (req, res) => {});\napp.delete('/path', (req, res) => {});\n```\n\n## Route Parameters\n\n```javascript\napp.get('/users/:id', (req, res) => {\n    const id = req.params.id;\n});\n```\n\n## Query Parameters\n\n```javascript\napp.get('/search', (req, res) => {\n    const { q } = req.query;\n});\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Buat CRUD routes untuk users.',
            'starter_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet users = [];\n\n',
            'solution_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet users = [];\nlet nextId = 1;\n\n// GET all\napp.get("/api/users", (req, res) => res.json(users));\n\n// GET one\napp.get("/api/users/:id", (req, res) => {\n    const user = users.find(u => u.id === parseInt(req.params.id));\n    if (!user) return res.status(404).json({ error: "Not found" });\n    res.json(user);\n});\n\n// POST\napp.post("/api/users", (req, res) => {\n    const user = { id: nextId++, ...req.body };\n    users.push(user);\n    res.status(201).json(user);\n});\n\napp.listen(3000);',
        ];
    }
    
    private function restPrinciples(): array
    {
        return [
            'content_html' => "# REST API Principles\n\n## HTTP Methods\n\n- `GET` - Retrieve resource\n- `POST` - Create resource\n- `PUT` - Update (replace)\n- `PATCH` - Update (partial)\n- `DELETE` - Delete resource\n\n## Status Codes\n\n- `200` OK\n- `201` Created\n- `204` No Content\n- `400` Bad Request\n- `404` Not Found\n- `500` Server Error",
            'programming_language' => 'javascript',
            'exercise_description' => 'Buat REST API untuk products.',
            'starter_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet products = [];\n\n',
            'solution_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet products = [\n    { id: 1, name: "Laptop", price: 999 },\n    { id: 2, name: "Mouse", price: 29 }\n];\n\n// GET all\napp.get("/api/products", (req, res) => res.json(products));\n\n// GET one\napp.get("/api/products/:id", (req, res) => {\n    const product = products.find(p => p.id === parseInt(req.params.id));\n    if (!product) return res.status(404).json({ error: "Not found" });\n    res.json(product);\n});\n\napp.listen(3000);',
        ];
    }
    
    private function crudEndpoints(): array
    {
        return [
            'content_html' => "# CRUD Endpoints\n\n## Complete CRUD\n\n```javascript\n// CREATE\napp.post('/users', (req, res) => {});\n\n// READ\napp.get('/users', (req, res) => {});\napp.get('/users/:id', (req, res) => {});\n\n// UPDATE\napp.put('/users/:id', (req, res) => {});\n\n// DELETE\napp.delete('/users/:id', (req, res) => {});\n```\n\n## Validation\n\n```javascript\nif (!name || !email) {\n    return res.status(400).json({ error: 'Required' });\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Implementasi lengkap CRUD operations.',
            'starter_code' => 'const express = require("express");\nconst app = express();\n\nlet items = [];\n\n',
            'solution_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet items = [];\nlet nextId = 1;\n\n// CREATE\napp.post("/api/items", (req, res) => {\n    if (!req.body.name) return res.status(400).json({ error: "Name required" });\n    const item = { id: nextId++, ...req.body };\n    items.push(item);\n    res.status(201).json(item);\n});\n\n// READ all\napp.get("/api/items", (req, res) => res.json(items));\n\n// READ one\napp.get("/api/items/:id", (req, res) => {\n    const item = items.find(i => i.id === parseInt(req.params.id));\n    if (!item) return res.status(404).json({ error: "Not found" });\n    res.json(item);\n});\n\n// UPDATE\napp.put("/api/items/:id", (req, res) => {\n    const item = items.find(i => i.id === parseInt(req.params.id));\n    if (!item) return res.status(404).json({ error: "Not found" });\n    Object.assign(item, req.body);\n    res.json(item);\n});\n\n// DELETE\napp.delete("/api/items/:id", (req, res) => {\n    const index = items.findIndex(i => i.id === parseInt(req.params.id));\n    if (index === -1) return res.status(404).json({ error: "Not found" });\n    items.splice(index, 1);\n    res.status(204).send();\n});\n\napp.listen(3000);',
        ];
    }
    
    private function jwtAuth(): array
    {
        return [
            'content_html' => "# JWT Authentication\n\n## Installation\n\n```bash\nnpm install jsonwebtoken bcryptjs\n```\n\n## Creating Token\n\n```javascript\nconst jwt = require('jsonwebtoken');\n\nconst token = jwt.sign(\n    { userId: 1, email: 'user@example.com' },\n    'secret-key',\n    { expiresIn: '1h' }\n);\n```\n\n## Verifying Token\n\n```javascript\nconst decoded = jwt.verify(token, 'secret-key');\n```\n\n## Auth Middleware\n\n```javascript\nfunction auth(req, res, next) {\n    const token = req.headers.authorization?.split(' ')[1];\n    req.user = jwt.verify(token, 'secret');\n    next();\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Implementasi JWT authentication.',
            'starter_code' => 'const jwt = require("jsonwebtoken");\nconst SECRET = "secret-key";\n\n',
            'solution_code' => 'const jwt = require("jsonwebtoken");\nconst bcrypt = require("bcryptjs");\nconst SECRET = "your-secret-key";\n\n// Create token\nfunction createToken(user) {\n    return jwt.sign(\n        { userId: user.id, email: user.email },\n        SECRET,\n        { expiresIn: "24h" }\n    );\n}\n\n// Verify token\nfunction verifyToken(token) {\n    return jwt.verify(token, SECRET);\n}\n\n// Auth middleware\nfunction authMiddleware(req, res, next) {\n    const token = req.headers.authorization?.split(" ")[1];\n    if (!token) return res.status(401).json({ error: "No token" });\n    try {\n        req.user = verifyToken(token);\n        next();\n    } catch (err) {\n        res.status(401).json({ error: "Invalid token" });\n    }\n}\n\nconsole.log("JWT Auth module loaded");',
        ];
    }
}
