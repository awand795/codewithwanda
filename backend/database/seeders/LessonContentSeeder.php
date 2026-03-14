<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonContentSeeder extends Seeder
{
    public function run(): void
    {
        // HTML & CSS Course - Lesson Content
        $this->createHtmlCssContent();
        
        // JavaScript Course - Lesson Content
        $this->createJavaScriptContent();
        
        // Node.js Course - Lesson Content
        $this->createNodeJSContent();
    }

    private function createHtmlCssContent(): void
    {
        // Lesson: How the Web Works
        $lesson = Lesson::where('slug', 'how-the-web-works')->first();
        if ($lesson) {
            $lesson->update([
                'content_html' => $this->getHowWebWorksContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Create a simple HTML file with DOCTYPE, html, head, and body tags. Add a title and a heading.',
                'starter_code' => '<!-- Create your HTML structure below -->\n\n',
                'solution_code' => '<!DOCTYPE html>\n<html lang="en">\n<head>\n    <meta charset="UTF-8">\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n    <title>My First Page</title>\n</head>\n<body>\n    <h1>Hello World!</h1>\n</body>\n</html>',
                'test_cases' => [
                    [
                        'input' => '',
                        'expected_output' => 'DOCTYPE',
                    ],
                ],
            ]);
        }

        // Lesson: HTML Document Structure
        $lesson = Lesson::where('slug', 'html-document-structure')->first();
        if ($lesson) {
            $lesson->update([
                'content_html' => $this->getHtmlStructureContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Create a complete HTML5 document structure with proper meta tags, title, and semantic elements.',
                'starter_code' => '<!-- Create a complete HTML5 document -->\n<!DOCTYPE html>\n\n',
                'solution_code' => $this->getHtmlStructureSolution(),
                'test_cases' => [],
            ]);
        }
    }

    private function createJavaScriptContent(): void
    {
        // Lesson: Introduction to JavaScript
        $lesson = Lesson::where('slug', 'intro-to-javascript')->first();
        if ($lesson) {
            $lesson->update([
                'content_html' => $this->getIntroToJSContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Create a variable and print "Hello, World!" to the console.',
                'starter_code' => '// Write your JavaScript code here\n\n',
                'solution_code' => '// Declare a variable\nconst greeting = "Hello, World!";\n\n// Print to console\nconsole.log(greeting);',
                'test_cases' => [
                    [
                        'input' => '',
                        'expected_output' => 'Hello, World!',
                    ],
                ],
            ]);
        }

        // Lesson: Variables and Data Types
        $lesson = Lesson::where('slug', 'variables-data-types')->first();
        if ($lesson) {
            $lesson->update([
                'content_html' => $this->getVariablesContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Declare variables using let, const, and different data types (string, number, boolean, object, array).',
                'starter_code' => '// Declare different types of variables\n\n',
                'solution_code' => $this->getVariablesSolution(),
                'test_cases' => [],
            ]);
        }
    }

    private function createNodeJSContent(): void
    {
        // Lesson: What is Node.js
        $lesson = Lesson::where('slug', 'what-is-nodejs')->first();
        if ($lesson) {
            $lesson->update([
                'content_html' => $this->getWhatIsNodeJSContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Create a simple Node.js program that prints "Hello from Node.js!" to the console.',
                'starter_code' => '// Write your Node.js code here\n\n',
                'solution_code' => '// Simple Node.js program\nconsole.log("Hello from Node.js!");\n\n// You can also use process object\nconsole.log(`Node.js version: ${process.version}`);',
                'test_cases' => [
                    [
                        'input' => '',
                        'expected_output' => 'Hello from Node.js!',
                    ],
                ],
            ]);
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

    private function getHtmlStructureContent(): string
    {
        return <<<'MD'
# HTML Document Structure

## Introduction to HTML

HTML (HyperText Markup Language) is the standard markup language for creating web pages. It describes the structure of a web page using elements represented by tags.

## Basic HTML Document Structure

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page description for SEO">
    <title>Page Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Content goes here -->
    <header>
        <h1>My Website</h1>
    </header>
    <main>
        <p>Welcome to my website!</p>
    </main>
    <footer>
        <p>&copy; 2024 My Website</p>
    </footer>
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
- `lang` attribute specifies language (important for accessibility and SEO)

### Head Section
Contains metadata about the document (not displayed).

```html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title</title>
</head>
```

### Body Section
Contains all visible content.

```html
<body>
    <h1>Hello World</h1>
    <p>This is visible content.</p>
</body>
```

## Best Practices

1. Always include `<!DOCTYPE html>`
2. Set `lang` attribute on html element
3. Include viewport meta tag for responsive design
4. Use semantic elements (header, main, footer)
5. Close all tags properly

## Try It Yourself

Create a complete HTML5 document with proper structure in the code editor!
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
    <meta name="description" content="My first HTML page">
    <title>My First Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        main {
            padding: 20px;
        }
        footer {
            background: #f4f4f4;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to My Website</h1>
    </header>
    
    <main>
        <h2>About This Page</h2>
        <p>This is my first HTML page. I'm learning web development!</p>
        
        <h3>Things I've Learned:</h3>
        <ul>
            <li>HTML document structure</li>
            <li>DOCTYPE declaration</li>
            <li>Head and body sections</li>
        </ul>
    </main>
    
    <footer>
        <p>&copy; 2024 My First Website</p>
    </footer>
</body>
</html>
HTML;
    }

    private function getIntroToJSContent(): string
    {
        return <<<'MD'
# Introduction to JavaScript

## What is JavaScript?

JavaScript is a programming language that adds interactivity to websites. It's one of the three core technologies of the web, along with HTML and CSS.

## What Can JavaScript Do?

- **Manipulate HTML** - Change content, styles, and structure dynamically
- **Respond to Events** - React to user actions like clicks, keypresses, etc.
- **Validate Forms** - Check user input before submitting
- **Create Animations** - Move elements, fade in/out, etc.
- **Make API Calls** - Fetch data from servers without reloading

## Your First JavaScript

```javascript
// This is a comment - it won't be executed
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
JavaScript statements are instructions to the browser. They end with a semicolon.

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
  spans multiple lines
*/
```

### Output
```javascript
// Console output (for debugging)
console.log("Message");

// Alert box
alert("Warning!");

// HTML content
document.write("<h1>Hello</h1>");
```

## Try It Yourself

Use the code editor to write your first JavaScript program. Print "Hello, World!" to the console!

## Key Takeaways

1. JavaScript adds interactivity to websites
2. Code is written in statements ending with semicolons
3. `console.log()` is used for output
4. Variables store data values
MD;
    }

    private function getVariablesContent(): string
    {
        return <<<'MD'
# Variables and Data Types

## Declaring Variables

JavaScript provides three ways to declare variables:

### let - Block Scoped, Reassignable
```javascript
let count = 0;
count = 1; // ✓ Can reassign
```

### const - Block Scoped, Cannot Reassign
```javascript
const PI = 3.14;
PI = 3; // ✗ Error: cannot reassign

const obj = {};
obj.key = 'value'; // ✓ Can modify properties
```

### var - Function Scoped (Legacy - Avoid)
```javascript
var name = 'John'; // Avoid in modern code
```

## Data Types

### Primitive Types

```javascript
// String
const text = 'Hello';
const template = `Hello ${name}`;

// Number
const int = 42;
const float = 3.14;
const infinity = Infinity;
const nan = NaN;

// Boolean
const isTrue = true;
const isFalse = false;

// Null
const empty = null;

// Undefined
let notDefined; // undefined

// Symbol
const id = Symbol('unique-id');

// BigInt
const big = 9007199254740991n;
```

### Reference Types

```javascript
// Object
const person = {
    name: 'John',
    age: 30,
    isStudent: false
};

// Array
const numbers = [1, 2, 3, 4, 5];

// Function
function greet(name) {
    return `Hello, ${name}!`;
}

// Date
const now = new Date();
```

## Type Checking

```javascript
typeof 'Hello'      // "string"
typeof 42           // "number"
typeof true         // "boolean"
typeof undefined    // "undefined"
typeof null         // "object" (bug in JS)
typeof {}           // "object"
typeof []           // "object"
typeof function(){} // "function"
```

## Type Conversion

```javascript
// String to Number
Number('42')        // 42
parseInt('42px')    // 42
parseFloat('3.14')  // 3.14

// Number to String
String(42)          // '42'
(42).toString()     // '42'

// Boolean conversion
Boolean(1)          // true
Boolean(0)          // false
Boolean('')         // false
Boolean('hello')    // true
```

## Try It Yourself

Create variables of different types and log them to the console!
MD;
    }

    private function getVariablesSolution(): string
    {
        return <<<'JS'
// String variable
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

    private function getWhatIsNodeJSContent(): string
    {
        return <<<'MD'
# What is Node.js?

## Introduction

Node.js is a JavaScript runtime built on Chrome's V8 JavaScript engine. It allows you to run JavaScript on the server, not just in the browser.

## Why Node.js?

### 1. JavaScript Everywhere
Use the same language for both frontend and backend development.

### 2. Fast and Efficient
- Built on Chrome's V8 engine (same as Chrome browser)
- Non-blocking I/O model
- Event-driven architecture

### 3. Large Ecosystem
- NPM (Node Package Manager) has over 2 million packages
- Active community and extensive documentation

### 4. Scalable
- Handles thousands of concurrent connections
- Perfect for real-time applications

## Use Cases

- **REST APIs** - Build backend services
- **Real-time Apps** - Chat, gaming, collaboration tools
- **Microservices** - Modular, scalable architecture
- **Command Line Tools** - Build developer tools
- **Serverless Functions** - Cloud-based functions

## Your First Node.js Program

```javascript
// Simple Node.js program
console.log("Hello from Node.js!");

// Access Node.js globals
console.log(`Node.js version: ${process.version}`);
console.log(`Platform: ${process.platform}`);
console.log(`Current directory: ${process.cwd()}`);
```

## Node.js vs Browser JavaScript

| Feature | Browser | Node.js |
|---------|---------|---------|
| DOM Access | ✓ | ✗ |
| Window Object | ✓ | ✗ |
| File System | ✗ | ✓ |
| HTTP Server | ✗ | ✓ |
| NPM Packages | Limited | Full Access |

## Try It Yourself

Use the code editor to write a Node.js program that prints information about your environment!

## Key Takeaways

1. Node.js runs JavaScript on the server
2. It's fast, scalable, and has a huge ecosystem
3. Perfect for APIs and real-time applications
4. Uses the same JavaScript syntax you already know
MD;
    }
}
