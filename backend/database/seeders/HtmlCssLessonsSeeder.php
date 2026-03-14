<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class HtmlCssLessonsSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = [
            'how-the-web-works' => $this->howWebWorks(),
            'setting-up-development-environment' => $this->devEnvironment(),
            'html-document-structure' => $this->htmlStructure(),
            'working-with-text-elements' => $this->textElements(),
            'links-images-media' => $this->linksImages(),
            'lists-tables-forms' => $this->listsTablesForms(),
            'semantic-elements-overview' => $this->semanticElements(),
            'building-semantic-page-structure' => $this->semanticPageStructure(),
            'web-accessibility-fundamentals' => $this->accessibility(),
            'css-syntax-selectors' => $this->cssSyntax(),
            'colors-backgrounds-borders' => $this->colorsBackgrounds(),
            'the-box-model-explained' => $this->boxModel(),
            'typography-fonts' => $this->typography(),
            'flexbox-fundamentals' => $this->flexbox(),
            'flex-container-properties' => $this->flexContainer(),
            'flex-item-properties' => $this->flexItem(),
            'building-navbar-flexbox' => $this->navbarFlexbox(),
            'grid-fundamentals' => $this->gridFundamentals(),
            'grid-template-areas' => $this->gridTemplateAreas(),
            'responsive-grid-layouts' => $this->responsiveGrid(),
            'media-queries' => $this->mediaQueries(),
            'mobile-first-design' => $this->mobileFirst(),
            'responsive-images-videos' => $this->responsiveMedia(),
            'css-transitions-animations' => $this->cssAnimations(),
            'css-variables' => $this->cssVariables(),
            'css-best-practices' => $this->cssBestPractices(),
            'portfolio-project-setup' => $this->portfolioSetup(),
            'portfolio-header-hero' => $this->portfolioHeader(),
            'portfolio-projects-gallery' => $this->portfolioGallery(),
            'portfolio-contact-footer' => $this->portfolioFooter(),
            'portfolio-deployment' => $this->portfolioDeployment(),
        ];

        $this->updateLessons($lessons);
    }

    private function updateLessons(array $lessons): void
    {
        foreach ($lessons as $slugPattern => $content) {
            $updated = Lesson::where('slug', 'like', "%{$slugPattern}%")->update($content);
            if ($updated) {
                $this->command->info("Updated: {$slugPattern}");
            }
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

    private function devEnvironment(): array
    {
        return [
            'content_html' => "# Setting Up Development Environment\n\n## Essential Tools\n\n### 1. Visual Studio Code\n- Free code editor\n- Extensions for web development\n\n### 2. Chrome Browser\n- Developer Tools\n- Fast performance\n\n### 3. Git\n- Version control\n- Collaboration\n\n## Project Structure\n\n```\nmy-project/\n├── index.html\n├── css/\n│   └── style.css\n├── js/\n│   └── main.js\n└── images/\n```",
            'programming_language' => 'html',
            'exercise_description' => 'Buat struktur folder project.',
            'starter_code' => '<!-- Buat struktur project -->\n\n',
            'solution_code' => '<!DOCTYPE html>\n<html lang="en">\n<head>\n    <meta charset="UTF-8">\n    <title>My Project</title>\n    <link rel="stylesheet" href="css/style.css">\n</head>\n<body>\n    <h1>Project Structure</h1>\n    <script src="js/main.js"></script>\n</body>\n</html>',
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

    private function listsTablesForms(): array
    {
        return [
            'content_html' => "# Lists, Tables, and Forms\n\n## Forms\n\n```html\n<form>\n    <label>Name:</label>\n    <input type=\"text\" name=\"name\" required>\n    <button type=\"submit\">Submit</button>\n</form>\n```\n\n## Input Types\n\n- `text` - Text input\n- `email` - Email validation\n- `password` - Password field\n- `number` - Number input",
            'programming_language' => 'html',
            'exercise_description' => 'Buat form registrasi.',
            'starter_code' => '<form>\n    \n</form>',
            'solution_code' => '<form>\n    <label>Name: <input type="text" name="name" required></label>\n    <label>Email: <input type="email" name="email" required></label>\n    <label>Password: <input type="password" name="password" required></label>\n    <button type="submit">Register</button>\n</form>',
        ];
    }

    private function semanticElements(): array
    {
        return [
            'content_html' => "# Semantic HTML5 Elements\n\n## Why Semantic?\n\n- Better accessibility\n- Better SEO\n- Easier to maintain\n\n## Common Semantic Elements\n\n- `<header>` - Introductory content\n- `<nav>` - Navigation links\n- `<article>` - Independent content\n- `<section>` - Thematic grouping\n- `<aside>` - Related content\n- `<footer>` - Footer section",
            'programming_language' => 'html',
            'exercise_description' => 'Buat layout dengan semantic elements.',
            'starter_code' => '<!-- Semantic HTML5 layout -->\n\n',
            'solution_code' => '<header>\n    <nav>Navigation</nav>\n</header>\n<main>\n    <article>\n        <h1>Article Title</h1>\n        <p>Content...</p>\n    </article>\n    <aside>Sidebar</aside>\n</main>\n<footer>Footer</footer>',
        ];
    }

    private function semanticPageStructure(): array
    {
        return [
            'content_html' => "# Building Semantic Page Structure\n\n## Complete Page Structure\n\n```html\n<!DOCTYPE html>\n<html>\n<head>\n    <title>Page</title>\n</head>\n<body>\n    <header>...</header>\n    <nav>...</nav>\n    <main>\n        <article>...</article>\n    </main>\n    <footer>...</footer>\n</body>\n</html>\n```",
            'programming_language' => 'html',
            'exercise_description' => 'Buat struktur halaman lengkap.',
            'starter_code' => '<!-- Complete semantic page -->\n\n',
            'solution_code' => '<!DOCTYPE html>\n<html>\n<body>\n    <header>\n        <h1>Website</h1>\n        <nav>...</nav>\n    </header>\n    <main>\n        <article>...</article>\n    </main>\n    <footer>...</footer>\n</body>\n</html>',
        ];
    }

    private function accessibility(): array
    {
        return [
            'content_html' => "# Web Accessibility Fundamentals\n\n## What is Accessibility?\n\nMaking websites usable by everyone, including people with disabilities.\n\n## Key Practices\n\n- Use semantic HTML\n- Add alt text to images\n- Use ARIA labels when needed\n- Ensure keyboard navigation\n- Maintain color contrast\n\n## ARIA Labels\n\n```html\n<nav aria-label=\"Main navigation\">\n<button aria-label=\"Close dialog\">×</button>\n```",
            'programming_language' => 'html',
            'exercise_description' => 'Buat halaman accessible.',
            'starter_code' => '<!-- Accessible page -->\n\n',
            'solution_code' => '<nav aria-label="Main navigation">\n    <ul>\n        <li><a href="/" aria-current="page">Home</a></li>\n    </ul>\n</nav>\n<button aria-label="Close">×</button>\n<img src="logo.png" alt="Company Logo">',
        ];
    }

    private function cssSyntax(): array
    {
        return [
            'content_html' => "# CSS Syntax and Selectors\n\n## Basic Syntax\n\n```css\nselector {\n    property: value;\n}\n```\n\n## Selectors\n\n- Element: `p { }`\n- Class: `.classname { }`\n- ID: `#idname { }`\n- Attribute: `input[type=\"text\"] { }`\n\n## Pseudo-classes\n\n```css\na:hover { color: red; }\nli:first-child { font-weight: bold; }\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Buat CSS dengan berbagai selectors.',
            'starter_code' => '/* CSS Selectors */\n\n',
            'solution_code' => '/* Element */\nbody { font-family: Arial; }\n\n/* Class */\n.container { max-width: 1200px; }\n\n/* ID */\n#header { background: #333; }\n\n/* Pseudo-class */\na:hover { color: blue; }',
        ];
    }

    private function colorsBackgrounds(): array
    {
        return [
            'content_html' => "# Colors, Backgrounds, and Borders\n\n## Color Formats\n\n```css\n/* Named */\ncolor: red;\n\n/* Hex */\ncolor: #ff0000;\n\n/* RGB */\ncolor: rgb(255, 0, 0);\n\n/* RGBA */\ncolor: rgba(255, 0, 0, 0.5);\n```\n\n## Backgrounds\n\n```css\nbackground: #f0f0f0 url('image.jpg') no-repeat center;\n```\n\n## Borders\n\n```css\nborder: 2px solid #333;\nborder-radius: 10px;\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Styling dengan colors dan borders.',
            'starter_code' => '.card {\n    \n}',
            'solution_code' => '.card {\n    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);\n    border: 2px solid #333;\n    border-radius: 10px;\n    color: white;\n    padding: 20px;\n}',
        ];
    }

    private function boxModel(): array
    {
        return [
            'content_html' => "# The Box Model\n\n## Components\n\n```\n┌─ Margin ─────────────────┐\n│  ┌─ Border ────────────┐ │\n│  │  ┌─ Padding ──────┐ │ │\n│  │  │   Content      │ │ │\n│  │  └────────────────┘ │ │\n│  └─────────────────────┘ │\n└──────────────────────────┘\n```\n\n## CSS\n\n```css\n.box {\n    margin: 20px;\n    border: 1px solid #333;\n    padding: 15px;\n}\n```\n\n## Box Sizing\n\n```css\n* { box-sizing: border-box; }\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Demonstrasikan box model.',
            'starter_code' => '.card {\n    \n}',
            'solution_code' => '.card {\n    width: 300px;\n    margin: 20px;\n    padding: 20px;\n    border: 2px solid #3498db;\n    background: #f4f4f4;\n}',
        ];
    }

    private function typography(): array
    {
        return [
            'content_html' => "# Typography and Fonts\n\n## Font Properties\n\n```css\nbody {\n    font-family: Arial, sans-serif;\n    font-size: 16px;\n    line-height: 1.6;\n    color: #333;\n}\n```\n\n## Font Stack\n\n```css\nfont-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;\n```\n\n## Web Fonts\n\n```css\n@import url('https://fonts.googleapis.com/css2?family=Roboto');\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Styling typography.',
            'starter_code' => 'body {\n    \n}',
            'solution_code' => 'body {\n    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;\n    font-size: 16px;\n    line-height: 1.6;\n    color: #333;\n}\n\nh1 {\n    font-size: 2.5rem;\n    font-weight: bold;\n}',
        ];
    }

    private function flexbox(): array
    {
        return [
            'content_html' => "# Flexbox Fundamentals\n\n## Basic Flexbox\n\n```css\n.container {\n    display: flex;\n}\n```\n\n## Main Concepts\n\n1. Flex Container (parent)\n2. Flex Items (children)\n3. Main Axis (horizontal by default)\n4. Cross Axis (perpendicular)\n\n## Benefits\n\n- Automatic sizing\n- Easy alignment\n- Source order independence",
            'programming_language' => 'css',
            'exercise_description' => 'Buat layout dengan Flexbox.',
            'starter_code' => '.container {\n    display: flex;\n}',
            'solution_code' => '.container {\n    display: flex;\n    justify-content: center;\n    align-items: center;\n    gap: 20px;\n}',
        ];
    }

    private function flexContainer(): array
    {
        return [
            'content_html' => "# Flex Container Properties\n\n## display\n```css\ndisplay: flex;\n```\n\n## flex-direction\n```css\nflex-direction: row;        /* default */\nflex-direction: column;\n```\n\n## justify-content\n```css\njustify-content: center;\njustify-content: space-between;\n```\n\n## align-items\n```css\nalign-items: center;\nalign-items: stretch;\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Praktek flex container properties.',
            'starter_code' => '.flex-container {\n    \n}',
            'solution_code' => '.flex-container {\n    display: flex;\n    flex-direction: row;\n    justify-content: space-between;\n    align-items: center;\n    flex-wrap: wrap;\n    gap: 15px;\n}',
        ];
    }

    private function flexItem(): array
    {
        return [
            'content_html' => "# Flex Item Properties\n\n## flex-grow\n```css\nflex-grow: 0;  /* default */\nflex-grow: 1;  /* grow to fill space */\n```\n\n## flex-shrink\n```css\nflex-shrink: 1;  /* default */\nflex-shrink: 0;  /* don't shrink */\n```\n\n## flex shorthand\n```css\nflex: 0 1 auto;  /* grow shrink basis */\nflex: 1;         /* flex: 1 1 0 */\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Styling flex items.',
            'starter_code' => '.flex-item {\n    \n}',
            'solution_code' => '.flex-item {\n    flex: 1 1 200px;\n    align-self: stretch;\n    order: 1;\n}',
        ];
    }

    private function navbarFlexbox(): array
    {
        return [
            'content_html' => "# Building Navigation with Flexbox\n\n## HTML Structure\n\n```html\n<nav class=\"navbar\">\n    <div class=\"logo\">Logo</div>\n    <ul class=\"nav-links\">\n        <li><a href=\"#\">Home</a></li>\n        <li><a href=\"#\">About</a></li>\n    </ul>\n</nav>\n```\n\n## CSS\n\n```css\n.navbar {\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n}\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Buat responsive navbar.',
            'starter_code' => '.navbar {\n    \n}',
            'solution_code' => '.navbar {\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n    padding: 15px 30px;\n    background: #2c3e50;\n}\n\n.nav-links {\n    display: flex;\n    gap: 20px;\n    list-style: none;\n}',
        ];
    }

    private function gridFundamentals(): array
    {
        return [
            'content_html' => "# Grid Fundamentals\n\n## Basic Grid\n\n```css\n.container {\n    display: grid;\n    grid-template-columns: 200px 200px 200px;\n    grid-template-rows: 100px 100px;\n    gap: 20px;\n}\n```\n\n## fr Units\n\n```css\ngrid-template-columns: 1fr 2fr 1fr;\n```\n\n## repeat()\n\n```css\ngrid-template-columns: repeat(3, 1fr);\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Buat layout dengan CSS Grid.',
            'starter_code' => '.grid-container {\n    display: grid;\n}',
            'solution_code' => '.grid-container {\n    display: grid;\n    grid-template-columns: repeat(3, 1fr);\n    grid-template-rows: auto;\n    gap: 20px;\n}',
        ];
    }

    private function gridTemplateAreas(): array
    {
        return [
            'content_html' => "# Grid Template Areas\n\n## Named Areas\n\n```css\n.container {\n    display: grid;\n    grid-template-areas:\n        'header header header'\n        'sidebar main main'\n        'footer footer footer';\n}\n\n.header { grid-area: header; }\n.sidebar { grid-area: sidebar; }\n.main { grid-area: main; }\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Buat layout dengan grid areas.',
            'starter_code' => '.layout {\n    \n}',
            'solution_code' => '.layout {\n    display: grid;\n    grid-template-areas:\n        "header header header"\n        "sidebar main main"\n        "footer footer footer";\n}',
        ];
    }

    private function responsiveGrid(): array
    {
        return [
            'content_html' => "# Responsive Grid Layouts\n\n## Auto-fit Columns\n\n```css\n.container {\n    display: grid;\n    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));\n    gap: 20px;\n}\n```\n\n## Auto-fill\n\n```css\ngrid-template-columns: repeat(auto-fill, minmax(200px, 1fr));\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Buat responsive grid.',
            'starter_code' => '.responsive-grid {\n    \n}',
            'solution_code' => '.responsive-grid {\n    display: grid;\n    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));\n    gap: 20px;\n}',
        ];
    }

    private function mediaQueries(): array
    {
        return [
            'content_html' => "# Media Queries\n\n## Basic Syntax\n\n```css\n@media (max-width: 768px) {\n    .container {\n        width: 100%;\n    }\n}\n```\n\n## Common Breakpoints\n\n```css\n@media (min-width: 576px) { }  /* Small */\n@media (min-width: 768px) { }  /* Medium */\n@media (min-width: 992px) { }  /* Large */\n@media (min-width: 1200px) { } /* Extra large */\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Buat responsive design.',
            'starter_code' => '/* Mobile first */\n.container { }\n\n',
            'solution_code' => '/* Mobile first */\n.container {\n    padding: 1rem;\n}\n\n/* Tablet */\n@media (min-width: 768px) {\n    .container {\n        padding: 2rem;\n    }\n}\n\n/* Desktop */\n@media (min-width: 1024px) {\n    .container {\n        max-width: 1200px;\n        margin: 0 auto;\n    }\n}',
        ];
    }

    private function mobileFirst(): array
    {
        return [
            'content_html' => "# Mobile-First Design\n\n## Approach\n\n1. Design for mobile first\n2. Add complexity for larger screens\n3. Better performance on mobile\n\n## Example\n\n```css\n/* Mobile (base) */\n.container { padding: 1rem; }\n\n/* Tablet */\n@media (min-width: 768px) {\n    .container { padding: 2rem; }\n}\n\n/* Desktop */\n@media (min-width: 1024px) {\n    .container { max-width: 1200px; }\n}\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Implementasi mobile-first.',
            'starter_code' => '/* Mobile first approach */\n\n',
            'solution_code' => '/* Base (mobile) */\nbody {\n    font-size: 14px;\n}\n\n/* Tablet */\n@media (min-width: 768px) {\n    body {\n        font-size: 16px;\n    }\n}\n\n/* Desktop */\n@media (min-width: 1024px) {\n    body {\n        font-size: 18px;\n    }\n}',
        ];
    }

    private function responsiveMedia(): array
    {
        return [
            'content_html' => "# Responsive Images and Videos\n\n## Responsive Images\n\n```css\nimg {\n    max-width: 100%;\n    height: auto;\n}\n```\n\n## Responsive Video\n\n```css\n.video-container {\n    position: relative;\n    padding-bottom: 56.25%; /* 16:9 */\n    height: 0;\n}\n\n.video-container iframe {\n    position: absolute;\n    top: 0;\n    left: 0;\n    width: 100%;\n    height: 100%;\n}\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Buat media responsive.',
            'starter_code' => 'img, video {\n    \n}',
            'solution_code' => 'img, video {\n    max-width: 100%;\n    height: auto;\n}\n\n.video-container {\n    position: relative;\n    padding-bottom: 56.25%;\n    height: 0;\n}\n\n.video-container iframe {\n    position: absolute;\n    top: 0;\n    left: 0;\n    width: 100%;\n    height: 100%;\n}',
        ];
    }

    private function cssAnimations(): array
    {
        return [
            'content_html' => "# CSS Transitions and Animations\n\n## Transitions\n\n```css\n.button {\n    transition: background 0.3s ease;\n}\n\n.button:hover {\n    background: red;\n}\n```\n\n## Keyframe Animations\n\n```css\n@keyframes slideIn {\n    from { transform: translateX(-100%); }\n    to { transform: translateX(0); }\n}\n\n.element {\n    animation: slideIn 0.5s ease-out;\n}\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Buat animasi CSS.',
            'starter_code' => '.animated {\n    \n}',
            'solution_code' => '.animated {\n    transition: all 0.3s ease;\n}\n\n.animated:hover {\n    transform: scale(1.1);\n}\n\n@keyframes slideIn {\n    from { transform: translateX(-100%); }\n    to { transform: translateX(0); }\n}\n\n.slide-in {\n    animation: slideIn 0.5s ease-out;\n}',
        ];
    }

    private function cssVariables(): array
    {
        return [
            'content_html' => "# CSS Variables (Custom Properties)\n\n## Defining Variables\n\n```css\n:root {\n    --primary-color: #3498db;\n    --secondary-color: #2ecc71;\n    --font-size-base: 16px;\n}\n```\n\n## Using Variables\n\n```css\n.button {\n    background-color: var(--primary-color);\n    font-size: var(--font-size-base);\n}\n```",
            'programming_language' => 'css',
            'exercise_description' => 'Implementasi CSS variables.',
            'starter_code' => ':root {\n    \n}',
            'solution_code' => ':root {\n    --primary-color: #3498db;\n    --secondary-color: #2ecc71;\n    --font-size-base: 16px;\n    --spacing-unit: 8px;\n}\n\n.button {\n    background: var(--primary-color);\n    font-size: var(--font-size-base);\n    padding: calc(var(--spacing-unit) * 2);\n}',
        ];
    }

    private function cssBestPractices(): array
    {
        return [
            'content_html' => "# CSS Best Practices\n\n## BEM Naming\n\n```css\n.card { }\n.card__image { }\n.card__title { }\n.card--featured { }\n```\n\n## Organization\n\n1. Base styles\n2. Layout\n3. Components\n4. Utilities\n\n## Best Practices\n\n- Use CSS variables\n- Mobile-first approach\n- Avoid !important\n- Minimize nesting",
            'programming_language' => 'css',
            'exercise_description' => 'Organisasi CSS dengan BEM.',
            'starter_code' => '/* BEM methodology */\n\n',
            'solution_code' => '/* BEM: Block Element Modifier */\n.card { }\n.card__image { }\n.card__title { }\n.card--featured { }\n\n/* Organization */\n/* 1. Base\n   2. Layout\n   3. Components\n   4. Utilities */',
        ];
    }

    private function portfolioSetup(): array
    {
        return [
            'content_html' => "# Portfolio Project Setup\n\n## Project Structure\n\n```\nportfolio/\n├── index.html\n├── css/\n│   └── style.css\n├── js/\n│   └── main.js\n└── images/\n```\n\n## Planning\n\n1. Define sections\n2. Create wireframe\n3. Choose color scheme\n4. Gather assets",
            'programming_language' => 'html',
            'exercise_description' => 'Setup project portfolio.',
            'starter_code' => '<!-- Portfolio project structure -->\n\n',
            'solution_code' => '<!--\nportfolio/\n├── index.html\n├── css/\n│   └── style.css\n├── js/\n│   └── main.js\n└── images/\n-->',
        ];
    }

    private function portfolioHeader(): array
    {
        return [
            'content_html' => "# Building Header and Hero\n\n## HTML Structure\n\n```html\n<header class=\"hero\">\n    <nav class=\"navbar\">\n        <div class=\"logo\">Logo</div>\n        <ul class=\"nav-links\">...</ul>\n    </nav>\n    <div class=\"hero-content\">\n        <h1>Hi, I'm Developer</h1>\n        <p>Full Stack Developer</p>\n    </div>\n</header>\n```",
            'programming_language' => 'html',
            'exercise_description' => 'Build header dan hero.',
            'starter_code' => '<header class="hero">\n    \n</header>',
            'solution_code' => '<header class="hero">\n    <nav class="navbar">\n        <div class="logo">My Portfolio</div>\n        <ul class="nav-links">\n            <li><a href="#about">About</a></li>\n            <li><a href="#projects">Projects</a></li>\n            <li><a href="#contact">Contact</a></li>\n        </ul>\n    </nav>\n    <div class="hero-content">\n        <h1>Hi, I\'m Developer</h1>\n        <p>Full Stack Developer</p>\n    </div>\n</header>',
        ];
    }

    private function portfolioGallery(): array
    {
        return [
            'content_html' => "# Building Projects Gallery\n\n## HTML Structure\n\n```html\n<section class=\"projects\">\n    <h2>My Projects</h2>\n    <div class=\"projects-grid\">\n        <article class=\"project-card\">\n            <img src=\"project1.jpg\">\n            <h3>Project Title</h3>\n        </article>\n    </div>\n</section>\n```\n\n## CSS Grid\n\n```css\n.projects-grid {\n    display: grid;\n    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));\n    gap: 2rem;\n}\n```",
            'programming_language' => 'html',
            'exercise_description' => 'Build projects gallery.',
            'starter_code' => '<section class="projects">\n    \n</section>',
            'solution_code' => '<section class="projects">\n    <h2>My Projects</h2>\n    <div class="projects-grid">\n        <article class="project-card">\n            <img src="project1.jpg" alt="Project 1">\n            <h3>Project Title</h3>\n            <p>Description</p>\n        </article>\n    </div>\n</section>',
        ];
    }

    private function portfolioFooter(): array
    {
        return [
            'content_html' => "# Contact Form and Footer\n\n## Contact Form\n\n```html\n<section class=\"contact\">\n    <h2>Get In Touch</h2>\n    <form>\n        <input type=\"text\" placeholder=\"Name\">\n        <input type=\"email\" placeholder=\"Email\">\n        <textarea placeholder=\"Message\"></textarea>\n        <button type=\"submit\">Send</button>\n    </form>\n</section>\n```\n\n## Footer\n\n```html\n<footer>\n    <p>&copy; 2024 My Portfolio</p>\n</footer>\n```",
            'programming_language' => 'html',
            'exercise_description' => 'Build contact form dan footer.',
            'starter_code' => '<section class="contact">\n    \n</section>',
            'solution_code' => '<section class="contact">\n    <h2>Get In Touch</h2>\n    <form>\n        <input type="text" placeholder="Name" required>\n        <input type="email" placeholder="Email" required>\n        <textarea placeholder="Message"></textarea>\n        <button type="submit">Send</button>\n    </form>\n</section>\n\n<footer>\n    <p>&copy; 2024 My Portfolio</p>\n</footer>',
        ];
    }

    private function portfolioDeployment(): array
    {
        return [
            'content_html' => "# Deployment\n\n## Deploy to Netlify\n\n1. Build project\n2. Go to netlify.com\n3. Drag folder to Netlify\n4. Done!\n\n## Deploy with Git\n\n```bash\ngit init\ngit add .\ngit commit -m 'Initial commit'\ngit push origin main\n```\n\n## Connect to Netlify\n\n1. Netlify → New site from Git\n2. Choose repository\n3. Deploy",
            'programming_language' => 'html',
            'exercise_description' => 'Deploy ke Netlify/Vercel.',
            'starter_code' => '<!-- Deployment checklist -->\n\n',
            'solution_code' => '<!--\nDeployment Steps:\n1. Build project\n2. Test locally\n3. Push to GitHub\n4. Connect to Netlify/Vercel\n5. Configure custom domain\n6. Enable HTTPS\n-->',
        ];
    }
}
