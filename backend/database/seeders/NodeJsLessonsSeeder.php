<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class NodeJsLessonsSeeder extends Seeder
{
    public function run(): void
    {
        // What is Node.js
        Lesson::where('slug', 'like', '%what-is-nodejs%')->update([
            'content_html' => "# What is Node.js?\n\nNode.js is a JavaScript runtime built on Chrome's V8 engine.\n\n## Why Node.js?\n- JavaScript everywhere\n- Fast (non-blocking I/O)\n- Large ecosystem (NPM)\n\n```javascript\nconsole.log('Hello from Node.js!');\nconsole.log('Version:', process.version);\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Print Node.js info',
            'starter_code' => '// Node.js code\n\n',
            'solution_code' => 'console.log("Hello from Node.js!");\nconsole.log("Version:", process.version);\nconsole.log("Platform:", process.platform);',
            'test_cases' => [['input' => '', 'expected_output' => 'Hello from Node.js!']],
        ]);

        // Installing Node.js and NPM
        Lesson::where('slug', 'like', '%installing-nodejs-npm%')->update([
            'content_html' => "# Installing Node.js and NPM\n\n## Installation\n1. Download from nodejs.org\n2. Install LTS version\n3. Verify: `node --version`\n\n## NPM Basics\n```bash\nnpm init -y\nnpm install express\nnpm install --save-dev nodemon\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create package.json',
            'starter_code' => '// Command: npm init -y\n\n',
            'solution_code' => '{\n  "name": "my-app",\n  "version": "1.0.0",\n  "main": "index.js",\n  "scripts": {\n    "start": "node index.js",\n    "dev": "nodemon index.js"\n  }\n}',
        ]);

        // Node.js Module System
        Lesson::where('slug', 'like', '%nodejs-module-system%')->update([
            'content_html' => "# Node.js Module System\n\n```javascript\n// utils.js\nfunction add(a, b) { return a + b; }\nmodule.exports = { add };\n\n// main.js\nconst utils = require('./utils');\nconsole.log(utils.add(5, 3));\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create and use modules',
            'starter_code' => '// utils.js\n\n// main.js\n\n',
            'solution_code' => '// utils.js\nfunction add(a, b) { return a + b; }\nmodule.exports = { add };\n\n// main.js\nconst utils = require("./utils");\nconsole.log(utils.add(5, 3));',
        ]);

        // File System (fs) Module
        Lesson::where('slug', 'like', '%fs-module%')->update([
            'content_html' => "# File System Module\n\n```javascript\nconst fs = require('fs');\n\n// Write\nfs.writeFileSync('file.txt', 'Hello');\n\n// Read\nconst data = fs.readFileSync('file.txt', 'utf8');\nconsole.log(data);\n\n// Append\nfs.appendFileSync('file.txt', '\\nMore content');\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Read and write files',
            'starter_code' => 'const fs = require("fs");\n\n',
            'solution_code' => 'const fs = require("fs");\nfs.writeFileSync("example.txt", "Hello Node.js!");\nconst content = fs.readFileSync("example.txt", "utf8");\nconsole.log("Content:", content);',
        ]);

        // HTTP Module
        Lesson::where('slug', 'like', '%http-module%')->update([
            'content_html' => "# HTTP Module\n\n```javascript\nconst http = require('http');\n\nconst server = http.createServer((req, res) => {\n    res.writeHead(200, { 'Content-Type': 'application/json' });\n    res.end(JSON.stringify({ message: 'Hello!' }));\n});\n\nserver.listen(3000, () => {\n    console.log('Server running on port 3000');\n});\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create HTTP server',
            'starter_code' => 'const http = require("http");\n\n',
            'solution_code' => 'const http = require("http");\n\nconst server = http.createServer((req, res) => {\n    res.writeHead(200, { "Content-Type": "application/json" });\n    res.end(JSON.stringify({ message: "Hello!" }));\n});\n\nserver.listen(3000, () => {\n    console.log("Server running on port 3000");\n});',
        ]);

        // Introduction to Express.js
        Lesson::where('slug', 'like', '%intro-to-express%')->update([
            'content_html' => "# Introduction to Express.js\n\n```javascript\nconst express = require('express');\nconst app = express();\nconst PORT = 3000;\n\napp.get('/', (req, res) => {\n    res.json({ message: 'Welcome!' });\n});\n\napp.listen(PORT, () => {\n    console.log('Server running on port ' + PORT);\n});\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create Express server',
            'starter_code' => 'const express = require("express");\nconst app = express();\n\n',
            'solution_code' => 'const express = require("express");\nconst app = express();\nconst PORT = 3000;\n\napp.get("/", (req, res) => {\n    res.json({ message: "Welcome!" });\n});\n\napp.listen(PORT, () => {\n    console.log("Server running on port " + PORT);\n});',
        ]);

        // Express Routing
        Lesson::where('slug', 'like', '%express-routing%')->update([
            'content_html' => "# Express Routing\n\n```javascript\napp.get('/items', (req, res) => {\n    res.json(items);\n});\n\napp.post('/items', (req, res) => {\n    const item = { id: nextId++, ...req.body };\n    items.push(item);\n    res.status(201).json(item);\n});\n\napp.get('/items/:id', (req, res) => {\n    const item = items.find(i => i.id === parseInt(req.params.id));\n    res.json(item);\n});\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create CRUD routes',
            'starter_code' => 'const express = require("express");\nconst app = express();\n\nlet items = [];\n\n',
            'solution_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet items = [];\nlet nextId = 1;\n\napp.get("/api/items", (req, res) => res.json(items));\napp.post("/api/items", (req, res) => {\n    const item = { id: nextId++, ...req.body };\n    items.push(item);\n    res.status(201).json(item);\n});\napp.listen(3000);',
        ]);

        // Middleware Fundamentals
        Lesson::where('slug', 'like', '%express-middleware%')->update([
            'content_html' => "# Middleware Fundamentals\n\n```javascript\n// Logger middleware\nfunction logger(req, res, next) {\n    console.log(req.method, req.url);\n    next();\n}\n\napp.use(logger);\n\n// Auth middleware\nfunction auth(req, res, next) {\n    const token = req.headers.authorization;\n    if (!token) return res.status(401).json({ error: 'Unauthorized' });\n    next();\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create custom middleware',
            'starter_code' => 'const express = require("express");\nconst app = express();\n\n',
            'solution_code' => 'const express = require("express");\nconst app = express();\n\nfunction logger(req, res, next) {\n    console.log(new Date().toISOString(), req.method, req.url);\n    next();\n}\n\napp.use(logger);\napp.get("/", (req, res) => res.json({ status: "OK" }));\napp.listen(3000);',
        ]);

        // REST API Principles
        Lesson::where('slug', 'like', '%rest-api-principles%')->update([
            'content_html' => "# REST API Principles\n\n## HTTP Methods\n- GET - Retrieve\n- POST - Create\n- PUT - Update\n- DELETE - Delete\n\n## Status Codes\n- 200 OK\n- 201 Created\n- 400 Bad Request\n- 404 Not Found\n- 500 Server Error",
            'programming_language' => 'javascript',
            'exercise_description' => 'Create REST API',
            'starter_code' => 'const express = require("express");\nconst app = express();\n\nlet products = [];\n\n',
            'solution_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet products = [\n    { id: 1, name: "Laptop", price: 999 },\n    { id: 2, name: "Mouse", price: 29 }\n];\n\napp.get("/api/products", (req, res) => res.json(products));\napp.get("/api/products/:id", (req, res) => {\n    const p = products.find(p => p.id === parseInt(req.params.id));\n    if (!p) return res.status(404).json({ error: "Not found" });\n    res.json(p);\n});\napp.listen(3000);',
        ]);

        // CRUD Endpoints
        Lesson::where('slug', 'like', '%crud-endpoints%')->update([
            'content_html' => "# Building CRUD Endpoints\n\n```javascript\n// CREATE\napp.post('/items', (req, res) => {\n    const item = { id: nextId++, ...req.body };\n    items.push(item);\n    res.status(201).json(item);\n});\n\n// READ\napp.get('/items', (req, res) => res.json(items));\n\n// UPDATE\napp.put('/items/:id', (req, res) => {\n    const item = items.find(i => i.id === parseInt(req.params.id));\n    Object.assign(item, req.body);\n    res.json(item);\n});\n\n// DELETE\napp.delete('/items/:id', (req, res) => {\n    const index = items.findIndex(i => i.id === parseInt(req.params.id));\n    items.splice(index, 1);\n    res.status(204).send();\n});\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Implementasi CRUD',
            'starter_code' => 'const express = require("express");\nconst app = express();\n\nlet items = [];\n\n',
            'solution_code' => 'const express = require("express");\nconst app = express();\napp.use(express.json());\n\nlet items = [];\nlet nextId = 1;\n\napp.get("/api/items", (req, res) => res.json(items));\napp.post("/api/items", (req, res) => {\n    const item = { id: nextId++, ...req.body };\n    items.push(item);\n    res.status(201).json(item);\n});\napp.put("/api/items/:id", (req, res) => {\n    const item = items.find(i => i.id === parseInt(req.params.id));\n    if (!item) return res.status(404).json({ error: "Not found" });\n    Object.assign(item, req.body);\n    res.json(item);\n});\napp.delete("/api/items/:id", (req, res) => {\n    const index = items.findIndex(i => i.id === parseInt(req.params.id));\n    if (index === -1) return res.status(404).json({ error: "Not found" });\n    items.splice(index, 1);\n    res.status(204).send();\n});\napp.listen(3000);',
        ]);

        // JWT Authentication
        Lesson::where('slug', 'like', '%jwt-authentication%')->update([
            'content_html' => "# JWT Authentication\n\n```javascript\nconst jwt = require('jsonwebtoken');\nconst SECRET = 'secret-key';\n\n// Create token\nconst token = jwt.sign(\n    { userId: 1, email: 'user@example.com' },\n    SECRET,\n    { expiresIn: '24h' }\n);\n\n// Verify token\nconst decoded = jwt.verify(token, SECRET);\n```\n\n## Auth Middleware\n```javascript\nfunction auth(req, res, next) {\n    const token = req.headers.authorization?.split(' ')[1];\n    if (!token) return res.status(401).json({ error: 'No token' });\n    req.user = jwt.verify(token, SECRET);\n    next();\n}\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Implementasi JWT auth',
            'starter_code' => 'const jwt = require("jsonwebtoken");\nconst SECRET = "secret-key";\n\n',
            'solution_code' => 'const jwt = require("jsonwebtoken");\nconst SECRET = "your-secret-key";\n\nfunction createToken(user) {\n    return jwt.sign({ userId: user.id, email: user.email }, SECRET, { expiresIn: "24h" });\n}\n\nfunction verifyToken(token) {\n    return jwt.verify(token, SECRET);\n}\n\nfunction authMiddleware(req, res, next) {\n    const token = req.headers.authorization?.split(" ")[1];\n    if (!token) return res.status(401).json({ error: "No token" });\n    req.user = verifyToken(token);\n    next();\n}',
        ]);

        // Password Hashing with bcrypt
        Lesson::where('slug', 'like', '%password-hashing%')->update([
            'content_html' => "# Password Hashing with bcrypt\n\n```bash\nnpm install bcryptjs\n```\n\n```javascript\nconst bcrypt = require('bcryptjs');\n\n// Hash password\nconst salt = await bcrypt.genSalt(10);\nconst hashedPassword = await bcrypt.hash(password, salt);\n\n// Compare password\nconst isValid = await bcrypt.compare(password, hashedPassword);\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Hash password',
            'starter_code' => 'const bcrypt = require("bcryptjs");\n\n',
            'solution_code' => 'const bcrypt = require("bcryptjs");\n\nasync function hashPassword(password) {\n    const salt = await bcrypt.genSalt(10);\n    return await bcrypt.hash(password, salt);\n}\n\nasync function verifyPassword(password, hashed) {\n    return await bcrypt.compare(password, hashed);\n}\n\nconst password = "mypassword123";\nconst hashed = await hashPassword(password);\nconst isValid = await verifyPassword(password, hashed);\nconsole.log("Valid:", isValid);',
        ]);

        // Deploying to Production
        Lesson::where('slug', 'like', '%deploying-production%')->update([
            'content_html' => "# Deploying to Production\n\n## PM2 Process Manager\n```bash\nnpm install -g pm2\npm2 start app.js -i max\npm2 save\npm2 startup\n```\n\n## Nginx Reverse Proxy\n```nginx\nserver {\n    listen 80;\n    location / {\n        proxy_pass http://localhost:3000;\n    }\n}\n```\n\n## SSL with Let's Encrypt\n```bash\ncertbot --nginx -d yourdomain.com\n```",
            'programming_language' => 'javascript',
            'exercise_description' => 'Deploy checklist',
            'starter_code' => '// Deployment steps\n\n',
            'solution_code' => '# Deployment Steps:\n\n# 1. Set NODE_ENV=production\nexport NODE_ENV=production\n\n# 2. Install dependencies\nnpm install --production\n\n# 3. Use PM2\nnpm install -g pm2\npm2 start app.js -i max\npm2 save\npm2 startup\n\n# 4. Setup Nginx reverse proxy\n# 5. Enable SSL with certbot',
        ]);

        $this->command->info("Node.js lessons updated!");
    }
}
