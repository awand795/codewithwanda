<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class JavaScriptLessonsSeeder extends Seeder
{
    public function run(): void
    {
        // Intro to JavaScript
        Lesson::where('slug', 'like', '%intro-to-javascript%')->update([
            'content_html' => "# Introduction to JavaScript\n\nJavaScript is a programming language for web interactivity.\n\n```javascript\nconsole.log('Hello, World!');\nlet message = 'Welcome!';\n```\n\n## Output Methods\n- console.log() - Console output\n- alert() - Alert box\n- document.write() - Write to document",
            'programming_language' => 'javascript',
            'exercise_description' => 'Print Hello World',
            'starter_code' => '// Write code here\n\n',
            'solution_code' => 'console.log("Hello, World!");\nconsole.log("Welcome to JavaScript!");',
            'test_cases' => [['input' => '', 'expected_output' => 'Hello, World!']],
        ]);

        // Variables
        Lesson::where('slug', 'like', '%variables-data-types%')->update([
            'content_html' => "# Variables and Data Types\n\n```javascript\nlet count = 0;      // Reassignable\nconst PI = 3.14;    // Constant\n```\n\n## Data Types\n- String: 'Hello'\n- Number: 42\n- Boolean: true\n- Object: {}\n- Array: []",
            'programming_language' => 'javascript',
            'exercise_description' => 'Declare variables',
            'starter_code' => '// Declare variables\n\n',
            'solution_code' => 'const greeting = "Hello!";\nlet age = 25;\nconst pi = 3.14;\nconsole.log(greeting, age, pi);',
        ]);

        // Conditionals
        Lesson::where('slug', 'like', '%conditional-statements%')->update([
            'content_html' => "# Conditional Statements\n\n```javascript\nif (age >= 18) {\n    console.log('Adult');\n} else {\n    console.log('Minor');\n}\n```\n\n## Ternary\n```javascript\nconst status = (age >= 18) ? 'Adult' : 'Minor';\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create grading function',
            'starter_code' => 'function getGrade(score) {\n    \n}\n\n',
            'solution_code' => 'function getGrade(score) {\n    if (score >= 90) return "A";\n    else if (score >= 80) return "B";\n    else if (score >= 70) return "C";\n    else return "F";\n}\nconsole.log(getGrade(85));',
        ]);

        // Loops
        Lesson::where('slug', 'like', '%loops-for-while%')->update([
            'content_html' => "# Loops\n\n## for Loop\n```javascript\nfor (let i = 0; i < 5; i++) {\n    console.log(i);\n}\n```\n\n## while Loop\n```javascript\nlet i = 0;\nwhile (i < 5) {\n    console.log(i);\n    i++;\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Print 1-10 and sum',
            'starter_code' => 'let sum = 0;\n\n',
            'solution_code' => 'let sum = 0;\nfor (let i = 1; i <= 10; i++) {\n    console.log(i);\n    sum += i;\n}\nconsole.log("Total:", sum);',
        ]);

        // Functions
        Lesson::where('slug', 'like', '%function-declarations%')->update([
            'content_html' => "# Functions\n\n```javascript\nfunction greet(name) {\n    return 'Hello, ' + name;\n}\n\n// Arrow function\nconst greet = (name) => 'Hello, ' + name;\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create math functions',
            'starter_code' => 'function add(a, b) {\n    \n}\n\n',
            'solution_code' => 'function add(a, b) { return a + b; }\nconst subtract = (a, b) => a - b;\nfunction multiply(a, b) { return a * b; }\nconsole.log(add(5, 3));',
        ]);

        // Arrays
        Lesson::where('slug', 'like', '%arrays-and-array-methods%')->update([
            'content_html' => "# Arrays\n\n```javascript\nconst arr = [1, 2, 3];\n\n// map\nconst doubled = arr.map(x => x * 2);\n\n// filter\nconst evens = arr.filter(x => x % 2 === 0);\n\n// reduce\nconst sum = arr.reduce((a, b) => a + b, 0);\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Use array methods',
            'starter_code' => 'const numbers = [1, 2, 3, 4, 5];\n\n',
            'solution_code' => 'const numbers = [1, 2, 3, 4, 5];\nconst doubled = numbers.map(n => n * 2);\nconst evens = numbers.filter(n => n % 2 === 0);\nconst sum = numbers.reduce((a, b) => a + b, 0);\nconsole.log(doubled, evens, sum);',
        ]);

        // DOM
        Lesson::where('slug', 'like', '%intro-to-dom%')->update([
            'content_html' => "# DOM Manipulation\n\n```javascript\n// Select\nconst el = document.querySelector('.class');\n\n// Manipulate\nel.textContent = 'New text';\nel.style.color = 'red';\nel.classList.add('active');\n\n// Create\nconst div = document.createElement('div');\ndocument.body.appendChild(div);\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Manipulate DOM',
            'starter_code' => '// DOM manipulation\n\n',
            'solution_code' => 'const heading = document.querySelector("h1");\nheading.textContent = "New Heading!";\nheading.style.color = "blue";',
        ]);

        // Promises
        Lesson::where('slug', 'like', '%promises%')->update([
            'content_html' => "# Promises\n\n```javascript\nconst promise = new Promise((resolve, reject) => {\n    setTimeout(() => resolve('Success!'), 1000);\n});\n\npromise.then(result => console.log(result));\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create Promise',
            'starter_code' => 'const myPromise = new Promise((resolve, reject) => {\n    \n});\n\n',
            'solution_code' => 'const myPromise = new Promise((resolve) => {\n    setTimeout(() => resolve("Success!"), 1000);\n});\nmyPromise.then(result => console.log(result));',
        ]);

        // Async/Await
        Lesson::where('slug', 'like', '%async-await%')->update([
            'content_html' => "# Async/Await\n\n```javascript\nasync function fetchData() {\n    return 'data';\n}\n\nasync function getData() {\n    const result = await fetchData();\n    console.log(result);\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Use async/await',
            'starter_code' => 'async function getData() {\n    \n}\n\n',
            'solution_code' => 'async function fetchData() {\n    return new Promise(r => setTimeout(() => r({ id: 1 }), 1000));\n}\nasync function getData() {\n    const data = await fetchData();\n    console.log(data);\n}\ngetData();',
        ]);

        $this->command->info("JavaScript lessons updated!");
    }
}
