<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class ComprehensiveLessonContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedReactFundamentals();
        $this->seedLaravelFundamentals();
        $this->seedHtmlCssFundamentals();
        $this->seedJavaScriptFundamentals();
    }

    private function seedReactFundamentals(): void
    {
        $lessons = [
            // Lesson 1: Introduction to React
            'getting-started-with-react-introduction-to-react' => [
                'content_html' => $this->getReactIntroductionContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buatlah komponen React sederhana yang menampilkan nama Anda dan usia Anda dalam format kartu profil.',
                'starter_code' => '// Buat komponen ProfileCard di bawah ini\n// Komponennya harus menampilkan:\n// 1. Nama Anda\n// 2. Usia Anda\n// 3. Sebuah sapaan seperti "Halo, saya [nama]!"\n\nfunction ProfileCard() {\n  // Tulis kodemu di sini\n  \n}\n\nexport default ProfileCard;',
                'solution_code' => 'function ProfileCard() {\n  const name = "John Doe";\n  const age = 25;\n  \n  return (\n    <div style={{\n      border: "1px solid #ddd",\n      borderRadius: "8px",\n      padding: "20px",\n      maxWidth: "300px",\n      margin: "20px auto"\n    }}>\n      <h2>{name}</h2>\n      <p>Usia: {age} tahun</p>\n      <p>Halo, saya {name}!</p>\n    </div>\n  );\n}\n\nexport default ProfileCard;',
                'test_cases' => [
                    ['input' => '', 'expected_output' => 'John Doe'],
                    ['input' => '', 'expected_output' => 'Usia: 25 tahun'],
                    ['input' => '', 'expected_output' => 'Halo, saya John Doe!'],
                ],
                'quiz' => [
                    [
                        'question' => 'Apa itu React?',
                        'options' => [
                            'Database management system',
                            'JavaScript library untuk building user interfaces',
                            'Programming language',
                            'Web browser',
                        ],
                        'correct' => 1,
                        'explanation' => 'React adalah JavaScript library yang dikembangkan oleh Facebook untuk membangun user interface, khususnya untuk aplikasi single-page.',
                    ],
                    [
                        'question' => 'Apa kegunaan JSX dalam React?',
                        'options' => [
                            'Menghubungkan ke database',
                            'Menulis HTML di dalam JavaScript',
                            'Membuat server',
                            'Mengelola routing',
                        ],
                        'correct' => 1,
                        'explanation' => 'JSX (JavaScript XML) memungkinkan kita menulis markup HTML di dalam kode JavaScript React.',
                    ],
                ],
            ],
            
            // Lesson 2: Setting Up React Environment
            'getting-started-with-react-setting-up-react-environment' => [
                'content_html' => $this->getReactSetupContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buatlah komponen React yang menampilkan daftar tugas (to-do list) sederhana dengan minimal 3 item.',
                'starter_code' => '// Buat komponen TodoList\n// Tampilkan minimal 3 tugas dalam list\n\nfunction TodoList() {\n  // Tulis kodemu di sini\n  \n}\n\nexport default TodoList;',
                'solution_code' => 'function TodoList() {\n  const todos = [\n    "Belajar React",\n    "Membuat komponen pertama",\n    "Memahami JSX"\n  ];\n  \n  return (\n    <div>\n      <h2>Daftar Tugas</h2>\n      <ul>\n        {todos.map((todo, index) => (\n          <li key={index}>{todo}</li>\n        ))}\n      </ul>\n    </div>\n  );\n}\n\nexport default TodoList;',
                'test_cases' => [
                    ['input' => '', 'expected_output' => 'Daftar Tugas'],
                    ['input' => '', 'expected_output' => 'Belajar React'],
                    ['input' => '', 'expected_output' => 'Membuat komponen pertama'],
                ],
                'quiz' => [
                    [
                        'question' => 'Tools apa yang paling umum digunakan untuk membuat project React baru?',
                        'options' => [
                            'npm create-react-app',
                            'npm install react',
                            'npm start react',
                            'npm new react-app',
                        ],
                        'correct' => 0,
                        'explanation' => 'Create React App adalah tool resmi dari Facebook untuk membuat project React dengan konfigurasi nol.',
                    ],
                ],
            ],
            
            // Lesson 3: Your First React Component
            'getting-started-with-react-your-first-react-component' => [
                'content_html' => $this->getReactFirstComponentContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat komponen Button yang menerima props "label" dan "onClick", lalu tampilkan button tersebut.',
                'starter_code' => '// Buat komponen Button yang menerima props\n// Props: label (string) dan onClick (function)\n\nfunction Button(props) {\n  // Tulis kodemu di sini\n  \n}\n\nexport default Button;',
                'solution_code' => 'function Button({ label, onClick }) {\n  return (\n    <button \n      onClick={onClick}\n      style={{\n        padding: "10px 20px",\n        backgroundColor: "#007bff",\n        color: "white",\n        border: "none",\n        borderRadius: "4px",\n        cursor: "pointer"\n      }}\n    >\n      {label}\n    </button>\n  );\n}\n\nexport default Button;',
                'test_cases' => [
                    ['input' => '', 'expected_output' => '<button'],
                    ['input' => '', 'expected_output' => 'onClick'],
                ],
                'quiz' => [
                    [
                        'question' => 'Bagaimana cara menerima props di functional component?',
                        'options' => [
                            'Menggunakan this.props',
                            'Sebagai parameter function',
                            'Menggunakan useState',
                            'Menggunakan import',
                        ],
                        'correct' => 1,
                        'explanation' => 'Functional component menerima props sebagai parameter function pertama.',
                    ],
                ],
            ],
        ];

        $this->updateLessons($lessons);
    }

    private function seedLaravelFundamentals(): void
    {
        $lessons = [
            // Lesson: What is Laravel?
            'introduction-to-laravel-what-is-laravel' => [
                'content_html' => $this->getLaravelIntroductionContent(),
                'programming_language' => 'php',
                'exercise_description' => 'Buat route Laravel yang mengembalikan JSON response dengan data nama dan email Anda.',
                'starter_code' => '// routes/web.php\n// Buat route yang mengembalikan JSON\n\nRoute::get(\'/profile\', function () {\n    // Tulis kodemu di sini\n    \n});',
                'solution_code' => 'Route::get(\'/profile\', function () {\n    return response()->json([\n        \'name\' => \'John Doe\',\n        \'email\' => \'john@example.com\'\n    ]);\n});',
                'test_cases' => [
                    ['input' => '', 'expected_output' => 'John Doe'],
                    ['input' => '', 'expected_output' => 'john@example.com'],
                ],
                'quiz' => [
                    [
                        'question' => 'Siapa pencipta Laravel?',
                        'options' => [
                            'Mark Zuckerberg',
                            'Taylor Otwell',
                            'Rasmus Lerdorf',
                            'Ryan Dahl',
                        ],
                        'correct' => 1,
                        'explanation' => 'Laravel diciptakan oleh Taylor Otwell pada tahun 2011.',
                    ],
                    [
                        'question' => 'Apa itu Composer dalam konteks Laravel?',
                        'options' => [
                            'Text editor',
                            'Database',
                            'Dependency manager untuk PHP',
                            'Web server',
                        ],
                        'correct' => 2,
                        'explanation' => 'Composer adalah dependency manager untuk PHP yang digunakan untuk menginstall Laravel dan package-package lainnya.',
                    ],
                ],
            ],
            
            // Lesson: Laravel Directory Structure
            'introduction-to-laravel-laravel-directory-structure' => [
                'content_html' => $this->getLaravelDirectoryStructureContent(),
                'programming_language' => 'php',
                'exercise_description' => 'Buat Controller baru bernama "HomeController" dengan method "index" yang mengembalikan view "welcome".',
                'starter_code' => '// app/Http/Controllers/HomeController.php\n\nnamespace App\\Http\\Controllers;\n\nuse Illuminate\\Http\\Request;\n\nclass HomeController extends Controller\n{\n    // Buat method index di sini\n    \n}',
                'solution_code' => '<?php\n\nnamespace App\\Http\\Controllers;\n\nuse Illuminate\\Http\\Request;\n\nclass HomeController extends Controller\n{\n    public function index()\n    {\n        return view(\'welcome\');\n    }\n}',
                'test_cases' => [
                    ['input' => '', 'expected_output' => 'public function index()'],
                    ['input' => '', 'expected_output' => 'return view'],
                ],
                'quiz' => [
                    [
                        'question' => 'Di folder manakah kita menyimpan Controller di Laravel?',
                        'options' => [
                            'app/Models',
                            'app/Http/Controllers',
                            'routes',
                            'resources/views',
                        ],
                        'correct' => 1,
                        'explanation' => 'Controller disimpan di folder app/Http/Controllers.',
                    ],
                    [
                        'question' => 'Apa fungsi dari file routes/web.php?',
                        'options' => [
                            'Menyimpan konfigurasi database',
                            'Menyimpan definisi route untuk web application',
                            'Menyimpan view templates',
                            'Menyimpan model',
                        ],
                        'correct' => 1,
                        'explanation' => 'routes/web.php berisi definisi route untuk aplikasi web Laravel.',
                    ],
                ],
            ],
            
            // Lesson: Basic Routing
            'routing-and-controllers-basic-routing' => [
                'content_html' => $this->getLaravelRoutingContent(),
                'programming_language' => 'php',
                'exercise_description' => 'Buat 3 route: GET /about, GET /contact, dan GET /blog yang masing-masing mengembalikan string berbeda.',
                'starter_code' => '// routes/web.php\n// Buat 3 route berikut:\n// 1. GET /about - mengembalikan "About Us"\n// 2. GET /contact - mengembalikan "Contact Us"\n// 3. GET /blog - mengembalikan "Our Blog"\n\n',
                'solution_code' => 'Route::get(\'/about\', function () {\n    return \'About Us\';\n});\n\nRoute::get(\'/contact\', function () {\n    return \'Contact Us\';\n});\n\nRoute::get(\'/blog\', function () {\n    return \'Our Blog\';\n});',
                'test_cases' => [
                    ['input' => '', 'expected_output' => 'About Us'],
                    ['input' => '', 'expected_output' => 'Contact Us'],
                    ['input' => '', 'expected_output' => 'Our Blog'],
                ],
                'quiz' => [
                    [
                        'question' => 'HTTP method apa yang digunakan untuk GET route?',
                        'options' => [
                            'POST',
                            'GET',
                            'PUT',
                            'DELETE',
                        ],
                        'correct' => 1,
                        'explanation' => 'Route::get() digunakan untuk membuat route dengan HTTP GET method.',
                    ],
                    [
                        'question' => 'Bagaimana cara membuat route yang menerima parameter?',
                        'options' => [
                            'Route::get(\'/user/{id}\', ...)',
                            'Route::get(\'/user/:id\', ...)',
                            'Route::get(\'/user/?id\', ...)',
                            'Route::get(\'/user/*\', ...)',
                        ],
                        'correct' => 0,
                        'explanation' => 'Parameter route didefinisikan dengan kurung kurawal {id}.',
                    ],
                ],
            ],
        ];

        $this->updateLessons($lessons);
    }

    private function seedHtmlCssFundamentals(): void
    {
        $lessons = [
            // Lesson: How the Web Works
            'introduction-to-web-development-how-the-web-works' => [
                'content_html' => $this->getHowWebWorksContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Buat halaman HTML lengkap dengan DOCTYPE, html, head (dengan title), dan body (dengan h1 dan p).',
                'starter_code' => '<!-- Buat struktur HTML lengkap di bawah ini -->\n<!-- Harus ada: DOCTYPE, html, head, title, body, h1, p -->\n\n',
                'solution_code' => '<!DOCTYPE html>\n<html lang="id">\n<head>\n    <meta charset="UTF-8">\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n    <title>Halaman Pertamaku</title>\n</head>\n<body>\n    <h1>Selamat Datang di Website Saya</h1>\n    <p>Ini adalah paragraf pertama saya dalam HTML.</p>\n</body>\n</html>',
                'test_cases' => [
                    ['input' => '', 'expected_output' => '<!DOCTYPE html>'],
                    ['input' => '', 'expected_output' => '<html'],
                    ['input' => '', 'expected_output' => '<title>'],
                    ['input' => '', 'expected_output' => '<h1>'],
                ],
                'quiz' => [
                    [
                        'question' => 'Apa kepanjangan dari HTML?',
                        'options' => [
                            'Hyper Text Markup Language',
                            'High Tech Modern Language',
                            'Hyper Transfer Markup Language',
                            'Home Tool Markup Language',
                        ],
                        'correct' => 0,
                        'explanation' => 'HTML adalah singkatan dari Hyper Text Markup Language, bahasa standar untuk membuat halaman web.',
                    ],
                    [
                        'question' => 'Tag HTML apa yang digunakan untuk membuat link?',
                        'options' => [
                            '<link>',
                            '<a>',
                            '<href>',
                            '<url>',
                        ],
                        'correct' => 1,
                        'explanation' => 'Tag <a> (anchor) digunakan untuk membuat hyperlink di HTML.',
                    ],
                ],
            ],
            
            // Lesson: HTML Document Structure
            'html5-basics-html-document-structure' => [
                'content_html' => $this->getHtmlStructureContent(),
                'programming_language' => 'html',
                'exercise_description' => 'Buat dokumen HTML5 dengan semantic elements: header, nav, main, article, section, dan footer.',
                'starter_code' => '<!-- Buat struktur HTML5 dengan semantic elements -->\n<!DOCTYPE html>\n<html lang="id">\n\n</html>',
                'solution_code' => '<!DOCTYPE html>\n<html lang="id">\n<head>\n    <meta charset="UTF-8">\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n    <title>Struktur HTML5</title>\n</head>\n<body>\n    <header>\n        <h1>Website Saya</h1>\n        <nav>\n            <ul>\n                <li><a href="#home">Home</a></li>\n                <li><a href="#about">About</a></li>\n            </ul>\n        </nav>\n    </header>\n    \n    <main>\n        <article>\n            <h2>Judul Artikel</h2>\n            <section>\n                <p>Ini adalah konten artikel.</p>\n            </section>\n        </article>\n    </main>\n    \n    <footer>\n        <p>&copy; 2024 Website Saya</p>\n    </footer>\n</body>\n</html>',
                'test_cases' => [
                    ['input' => '', 'expected_output' => '<header>'],
                    ['input' => '', 'expected_output' => '<nav>'],
                    ['input' => '', 'expected_output' => '<main>'],
                    ['input' => '', 'expected_output' => '<footer>'],
                ],
                'quiz' => [
                    [
                        'question' => 'Apa keuntungan menggunakan semantic HTML?',
                        'options' => [
                            'Lebih cepat loadingnya',
                            'Lebih mudah dipahami browser dan assistive technologies',
                            'Lebih sedikit kode',
                            'Tidak ada keuntungan',
                        ],
                        'correct' => 1,
                        'explanation' => 'Semantic HTML membantu browser, search engines, dan assistive technologies memahami struktur dan makna konten.',
                    ],
                ],
            ],
        ];
    }

    private function seedJavaScriptFundamentals(): void
    {
        $lessons = [
            // Lesson: Intro to JavaScript
            'intro-to-javascript' => [
                'content_html' => $this->getJavaScriptIntroContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat program JavaScript yang menampilkan "Hello, World!" dan melakukan operasi matematika (penjumlahan, pengurangan, perkalian, pembagian).',
                'starter_code' => '// Tulis program JavaScript Anda di sini\n// 1. Tampilkan "Hello, World!"\n// 2. Buat 2 variabel angka\n// 3. Lakukan operasi matematika\n\n',
                'solution_code' => '// Program JavaScript Pertama\nconsole.log("Hello, World!");\n\n// Deklarasi variabel\nlet angka1 = 10;\nlet angka2 = 5;\n\n// Operasi matematika\nconsole.log("Penjumlahan:", angka1 + angka2);\nconsole.log("Pengurangan:", angka1 - angka2);\nconsole.log("Perkalian:", angka1 * angka2);\nconsole.log("Pembagian:", angka1 / angka2);\n\n// Modulus\nconsole.log("Modulus:", angka1 % angka2);',
                'test_cases' => [
                    ['input' => '', 'expected_output' => 'Hello, World!'],
                    ['input' => '', 'expected_output' => 'Penjumlahan: 15'],
                    ['input' => '', 'expected_output' => 'Perkalian: 50'],
                ],
                'quiz' => [
                    [
                        'question' => 'Bagaimana cara menampilkan output ke console di JavaScript?',
                        'options' => [
                            'print()',
                            'console.log()',
                            'echo()',
                            'System.out.println()',
                        ],
                        'correct' => 1,
                        'explanation' => 'console.log() adalah method untuk menampilkan output ke console di JavaScript.',
                    ],
                    [
                        'question' => 'Keyword apa yang digunakan untuk mendeklarasikan variabel yang tidak bisa diubah?',
                        'options' => [
                            'var',
                            'let',
                            'const',
                            'fixed',
                        ],
                        'correct' => 2,
                        'explanation' => 'const digunakan untuk mendeklarasikan variabel yang nilainya tidak bisa diubah (constant).',
                    ],
                ],
            ],
            
            // Lesson: Variables and Data Types
            'variables-data-types' => [
                'content_html' => $this->getVariablesContent(),
                'programming_language' => 'javascript',
                'exercise_description' => 'Buat program yang mendeklarasikan variabel dengan berbagai tipe data (string, number, boolean, null, undefined) dan tampilkan hasilnya.',
                'starter_code' => '// Deklarasikan variabel dengan berbagai tipe data\n// 1. String (nama)\n// 2. Number (usia)\n// 3. Boolean (status)\n// 4. null\n// 5. undefined\n// Tampilkan semua dengan console.log\n\n',
                'solution_code' => '// String\nlet nama = "John Doe";\n\n// Number\nlet usia = 25;\nlet harga = 99.99;\n\n// Boolean\nlet isStudent = true;\nlet isWorking = false;\n\n// Null\nlet kosong = null;\n\n// Undefined\nlet belumDiisi;\n\n// Menampilkan hasil\nconsole.log("Nama:", nama);\nconsole.log("Usia:", usia);\nconsole.log("Harga:", harga);\nconsole.log("Student:", isStudent);\nconsole.log("Working:", isWorking);\nconsole.log("Kosong:", kosong);\nconsole.log("Belum Diisi:", belumDiisi);\n\n// typeof operator\nconsole.log("\\nTipe Data:");\nconsole.log(typeof nama); // string\nconsole.log(typeof usia); // number\nconsole.log(typeof isStudent); // boolean\nconsole.log(typeof kosong); // object (quirk in JS)\nconsole.log(typeof belumDiisi); // undefined',
                'test_cases' => [
                    ['input' => '', 'expected_output' => 'Nama: John Doe'],
                    ['input' => '', 'expected_output' => 'Usia: 25'],
                    ['input' => '', 'expected_output' => 'string'],
                    ['input' => '', 'expected_output' => 'boolean'],
                ],
                'quiz' => [
                    [
                        'question' => 'Apa hasil dari typeof null di JavaScript?',
                        'options' => [
                            '"null"',
                            '"undefined"',
                            '"object"',
                            '"number"',
                        ],
                        'correct' => 2,
                        'explanation' => 'Karena bug historis di JavaScript, typeof null mengembalikan "object" bukan "null".',
                    ],
                    [
                        'question' => 'Perbedaan utama antara let dan var adalah?',
                        'options' => [
                            'Tidak ada perbedaan',
                            'let memiliki block scope, var memiliki function scope',
                            'var lebih baru dari let',
                            'let tidak bisa diubah',
                        ],
                        'correct' => 1,
                        'explanation' => 'let memiliki block scope (hanya berlaku dalam blok {}), sedangkan var memiliki function scope.',
                    ],
                ],
            ],
        ];
    }

    private function updateLessons(array $lessonsData): void
    {
        foreach ($lessonsData as $slug => $data) {
            // Try to find by slug first
            $updated = Lesson::where('slug', $slug)->update($data);
            
            // If not found by slug, try to find by title
            if (!$updated) {
                $title = $this->slugToTitle($slug);
                if ($title) {
                    Lesson::where('title', $title)->update($data);
                }
            }
        }
    }

    private function slugToTitle(string $slug): ?string
    {
        $slugToTitleMap = [
            // React
            'getting-started-with-react-introduction-to-react' => 'Introduction to React',
            'getting-started-with-react-setting-up-react-environment' => 'Setting Up React Environment',
            'getting-started-with-react-your-first-react-component' => 'Your First React Component',
            
            // Laravel
            'introduction-to-laravel-what-is-laravel' => 'What is Laravel?',
            'introduction-to-laravel-laravel-directory-structure' => 'Laravel Directory Structure',
            'routing-and-controllers-basic-routing' => 'Basic Routing',
            
            // HTML/CSS
            'introduction-to-web-development-how-the-web-works' => 'How the Web Works',
            'html5-basics-html-document-structure' => 'HTML Document Structure',
            
            // JavaScript
            'intro-to-javascript' => 'Intro to JavaScript',
            'variables-data-types' => 'Variables & Data Types',
        ];
        
        return $slugToTitleMap[$slug] ?? null;
    }

    // ==================== CONTENT GENERATORS ====================

    private function getReactIntroductionContent(): string
    {
        return <<<'MD'
# Introduction to React

## 🎯 Learning Objectives

Setelah menyelesaikan lesson ini, kamu akan mampu:
1. Memahami apa itu React dan mengapa React sangat populer
2. Menjelaskan konsep-konsep dasar React
3. Membuat komponen React pertama kamu
4. Memahami JSX dan cara kerjanya

---

## 📚 What is React?

**React** adalah sebuah **JavaScript library** yang dikembangkan oleh **Facebook** (sekarang Meta) pada tahun 2013 untuk membangun **user interface** (UI), khususnya untuk aplikasi **single-page application** (SPA).

### Mengapa React?

React telah menjadi salah satu library JavaScript paling populer karena beberapa alasan:

```
┌─────────────────────────────────────────────────────────┐
│                  KEUNTUNGAN REACT                       │
├─────────────────────────────────────────────────────────┤
│  🧩 Component-Based  - Reusable components              │
│  ⚡ Fast Performance - Virtual DOM optimization         │
│  📱 Cross-Platform   - React Native untuk mobile        │
│  👥 Large Community  - Banyak resources & libraries     │
│  🔧 Developer Tools  - React DevTools yang powerful    │
└─────────────────────────────────────────────────────────┘
```

---

## 🔑 Key Concepts

### 1. Components

Components adalah **building blocks** utama dalam React. Bayangkan components seperti **LEGO blocks** yang bisa kamu gabungkan untuk membangun sesuatu yang lebih besar.

```javascript
// Contoh sederhana sebuah component
function Welcome() {
  return <h1>Hello, World!</h1>;
}
```

### 2. JSX (JavaScript XML)

JSX adalah **syntax extension** yang memungkinkan kita menulis HTML di dalam JavaScript.

```javascript
// Tanpa JSX (cara lama)
React.createElement('h1', null, 'Hello, World!');

// Dengan JSX (cara modern - lebih mudah!)
const element = <h1>Hello, World!</h1>;
```

**Catatan penting tentang JSX:**
- JSX **bukan** string HTML, jadi jangan pakai quotes
- JSX **bisa** menggunakan JavaScript expressions dengan `{}`
- JSX **harus** memiliki satu parent element

```javascript
// ✅ BENAR
const name = "John";
const element = <h1>Hello, {name}</h1>;

// ✅ BENAR - Menggunakan expression
const element = <h1>{2 + 2}</h1>; // Akan menampilkan "4"

// ❌ SALAH - Multiple root elements
const element = (
  <h1>Hello</h1>
  <p>World</p>
);

// ✅ BENAR - Gunakan parent div atau Fragment
const element = (
  <div>
    <h1>Hello</h1>
    <p>World</p>
  </div>
);
```

### 3. Props (Properties)

**Props** adalah cara components berkomunikasi. Props memungkinkan kita mengirim data dari parent component ke child component.

```javascript
// Parent component
function App() {
  return <Welcome name="John" age={25} />;
}

// Child component menerima props
function Welcome(props) {
  return (
    <div>
      <h1>Hello, {props.name}!</h1>
      <p>Age: {props.age}</p>
    </div>
  );
}
```

---

## 💻 Practical Example

Mari kita buat **Profile Card** component yang menampilkan informasi user:

```javascript
function ProfileCard() {
  const user = {
    name: "John Doe",
    age: 25,
    occupation: "Software Developer",
    location: "Jakarta, Indonesia"
  };

  return (
    <div style={{
      border: "1px solid #ddd",
      borderRadius: "8px",
      padding: "20px",
      maxWidth: "300px",
      margin: "20px auto",
      fontFamily: "Arial, sans-serif"
    }}>
      <h2 style={{ color: "#333", marginBottom: "10px" }}>
        {user.name}
      </h2>
      <p style={{ color: "#666" }}>
        <strong>Age:</strong> {user.age} years old
      </p>
      <p style={{ color: "#666" }}>
        <strong>Occupation:</strong> {user.occupation}
      </p>
      <p style={{ color: "#666" }}>
        <strong>Location:</strong> {user.location}
      </p>
    </div>
  );
}

export default ProfileCard;
```

**Output yang akan dihasilkan:**

```
┌─────────────────────────────┐
│     John Doe                │
│                             │
│ Age: 25 years old           │
│ Occupation: Software        │
│             Developer       │
│ Location: Jakarta,          │
│           Indonesia         │
└─────────────────────────────┘
```

---

## 🎓 Best Practices

### 1. Component Naming
- Gunakan **PascalCase** untuk component names
- ✅ `UserProfile`, `NavBar`, `Footer`
- ❌ `userProfile`, `navBar`, `footer`

### 2. Code Organization
```javascript
// ✅ GOOD - Clear and organized
function ProductCard({ title, price, image }) {
  return (
    <div className="product-card">
      <img src={image} alt={title} />
      <h3>{title}</h3>
      <p>${price}</p>
    </div>
  );
}

// ❌ BAD - Hardcoded values
function ProductCard() {
  return (
    <div className="product-card">
      <img src="product.jpg" alt="Product" />
      <h3>Product Name</h3>
      <p>$99</p>
    </div>
  );
}
```

### 3. Keep Components Small
- Satu component = Satu tanggung jawab
- Jika component terlalu besar, pecah menjadi components yang lebih kecil

---

## ⚠️ Common Mistakes

### 1. Forgetting to Export
```javascript
// ❌ SALAH - Lupa export
function MyComponent() {
  return <div>Hello</div>;
}

// ✅ BENAR
function MyComponent() {
  return <div>Hello</div>;
}

export default MyComponent;
```

### 2. Multiple Root Elements
```javascript
// ❌ SALAH
function MyComponent() {
  return (
    <h1>Title</h1>
    <p>Content</p>
  );
}

// ✅ BENAR
function MyComponent() {
  return (
    <div>
      <h1>Title</h1>
      <p>Content</p>
    </div>
  );
}
```

---

## 📝 Summary

| Concept | Description |
|---------|-------------|
| **React** | JavaScript library untuk building UI |
| **Components** | Building blocks dari React applications |
| **JSX** | HTML-like syntax di JavaScript |
| **Props** | Data yang dikirim ke components |

**Key Takeaways:**
1. React membuat UI development lebih **modular** dan **reusable**
2. JSX membuat code lebih **readable** dan **easy to understand**
3. Components adalah **heart** dari React applications

---

## 🚀 Next Steps

Setelah memahami dasar-dasar React:
1. ✅ **Practice** - Buat component ProfileCard kamu sendiri
2. 📖 **Learn** - Setup React development environment
3. 💻 **Build** - Create your first React application

---

## 🧠 Quiz Time!

Test pemahaman kamu dengan menjawab pertanyaan berikut:

**1. Apa itu React?**
- A) Database management system
- B) JavaScript library untuk building user interfaces ✓
- C) Programming language
- D) Web browser

**2. Apa kegunaan JSX?**
- A) Menghubungkan ke database
- B) Menulis HTML di dalam JavaScript ✓
- C) Membuat server
- D) Mengelola routing

**3. Bagaimana cara mengirim data ke component?**
- A) Menggunakan state
- B) Menggunakan props ✓
- C) Menggunakan import
- D) Menggunakan export

---

**Selamat!** 🎉 Kamu telah menyelesaikan introduction ke React. Lanjut ke lesson berikutnya untuk setup environment!
MD;
    }

    private function getReactSetupContent(): string
    {
        return <<<'MD'
# Setting Up React Environment

## 🎯 Learning Objectives

1. Menginstall Node.js dan npm
2. Membuat project React pertama dengan Create React App
3. Memahami struktur folder project React
4. Menjalankan development server

---

## 📋 Prerequisites

Sebelum memulai, pastikan kamu sudah menginstall:

### 1. Node.js dan npm

**Node.js** adalah JavaScript runtime yang diperlukan untuk menjalankan React.

**Cara Install:**

1. Download dari [nodejs.org](https://nodejs.org)
2. Pilih versi **LTS** (Long Term Support)
3. Install seperti software biasa
4. Verify installation:

```bash
# Cek versi Node.js
node --version
# Output: v18.x.x atau lebih tinggi

# Cek versi npm
npm --version
# Output: 9.x.x atau lebih tinggi
```

### 2. Code Editor

Rekomendasi: **Visual Studio Code** (VS Code)

**Extensions yang disarankan:**
- ES7+ React/Redux/React-Native snippets
- Prettier - Code formatter
- ESLint
- Auto Rename Tag
- CSS Peek

---

## 🚀 Creating Your First React App

### Method 1: Create React App (Recommended for Beginners)

```bash
# Buat project baru
npx create-react-app my-first-app

# atau dengan npm
npm create-react-app my-first-app

# Masuk ke folder project
cd my-first-app

# Jalankan development server
npm start
```

### Method 2: Using Vite (Faster, Modern Alternative)

```bash
# Buat project dengan Vite
npm create vite@latest my-first-app -- --template react

# Masuk ke folder
cd my-first-app

# Install dependencies
npm install

# Jalankan development server
npm run dev
```

**Perbedaan CRA vs Vite:**

| Feature | Create React App | Vite |
|---------|------------------|------|
| Speed | Slower | ⚡ Very Fast |
| Configuration | Zero config | Minimal config |
| Popularity | More established | Growing rapidly |
| Hot Reload | Good | Excellent |

---

## 📁 Project Structure

Setelah project dibuat, kamu akan melihat struktur seperti ini:

```
my-first-app/
├── node_modules/        # Dependencies (JANGAN DIUBAH)
├── public/
│   ├── index.html       # HTML template
│   ├── favicon.ico      # Website icon
│   └── manifest.json    # PWA configuration
├── src/
│   ├── App.css          # Styles untuk App component
│   ├── App.js           # Main App component ⭐
│   ├── App.test.js      # Tests untuk App
│   ├── index.css        # Global styles
│   ├── index.js         # Entry point ⭐
│   └── logo.svg         # React logo
├── .gitignore           # Git ignore file
├── package.json         # Project configuration ⭐
├── package-lock.json    # Locked dependencies
└── README.md            # Documentation
```

### Files Penting yang Perlu Dikenali:

**1. `package.json`**
```json
{
  "name": "my-first-app",
  "version": "0.1.0",
  "private": true,
  "dependencies": {
    "react": "^18.2.0",
    "react-dom": "^18.2.0",
    "react-scripts": "5.0.1"
  },
  "scripts": {
    "start": "react-scripts start",
    "build": "react-scripts build",
    "test": "react-scripts test",
    "eject": "react-scripts eject"
  }
}
```

**2. `src/index.js`** - Entry Point
```javascript
import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import './index.css';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
```

**3. `src/App.js`** - Main Component
```javascript
import './App.css';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <h1>Welcome to React</h1>
      </header>
    </div>
  );
}

export default App;
```

---

## 🏃 Running Your App

```bash
# Start development server
npm start

# App akan berjalan di:
# http://localhost:3000
```

**Development server features:**
- ⚡ **Hot Reload** - Changes automatically refresh
- 🔍 **Error Overlay** - Shows errors in browser
- 📦 **Bundling** - Combines all files automatically

---

## 💻 Practical Exercise

**Tugas:** Modifikasi `App.js` untuk menampilkan informasi diri kamu.

```javascript
import './App.css';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <h1>Halo, Saya [Nama Kamu]!</h1>
        <p>Saya sedang belajar React</p>
        <p>Usia: [Usia Kamu] tahun</p>
        <p>Kota: [Kota Kamu]</p>
      </header>
    </div>
  );
}

export default App;
```

---

## 🎓 Best Practices

### 1. Folder Organization
```
src/
├── components/     # Reusable components
├── pages/          # Page components
├── hooks/          # Custom hooks
├── utils/          # Helper functions
├── assets/         # Images, fonts, etc.
└── styles/         # Global styles
```

### 2. Component File Naming
- ✅ `UserProfile.js`, `NavBar.js`, `Footer.js`
- ❌ `userProfile.js`, `navbar.js`, `footer_component.js`

### 3. Git Best Practices
```bash
# .gitignore yang baik sudah termasuk:
node_modules/
build/
.env
.DS_Store
```

---

## ⚠️ Common Issues & Solutions

### Issue 1: Port Already in Use
```
Something is already running on port 3000.
```

**Solution:**
```bash
# Kill process on port 3000 (Windows)
netstat -ano | findstr :3000
taskkill /PID <PID> /F

# Atau gunakan port lain
PORT=3001 npm start
```

### Issue 2: Module Not Found
```
Module not found: Can't resolve '...'
```

**Solution:**
```bash
# Reinstall dependencies
rm -rf node_modules package-lock.json
npm install
```

---

## 📝 Summary

| Command | Description |
|---------|-------------|
| `npx create-react-app app-name` | Create new React app |
| `npm start` | Start development server |
| `npm run build` | Create production build |
| `npm test` | Run tests |

---

## 🧠 Quiz

**1. Apa fungsi dari `npm start`?**
- A) Install dependencies
- B) Start development server ✓
- C) Build production app
- D) Run tests

**2. File apa yang merupakan entry point React app?**
- A) `App.js`
- B) `index.html`
- C) `src/index.js` ✓
- D) `package.json`

---

**Selamat!** 🎉 Environment React kamu sudah siap. Lanjut ke lesson berikutnya!
MD;
    }

    private function getReactFirstComponentContent(): string
    {
        return <<<'MD'
# Your First React Component

## 🎯 Learning Objectives

1. Membuat functional component pertama
2. Memahami props dan cara menggunakannya
3. Styling components
4. Component composition

---

## 📚 What is a Component?

**Component** adalah fungsi JavaScript yang mengembalikan HTML (melalui JSX).

```javascript
// Simple functional component
function Greeting() {
  return <h1>Hello, World!</h1>;
}

export default Greeting;
```

---

## 💻 Creating Your First Component

### Step 1: Create Component File

Buat file baru: `src/components/Greeting.js`

```javascript
// src/components/Greeting.js

function Greeting() {
  return (
    <div>
      <h1>Hello, World!</h1>
      <p>Welcome to React Components</p>
    </div>
  );
}

export default Greeting;
```

### Step 2: Use Component in App

```javascript
// src/App.js
import Greeting from './components/Greeting';

function App() {
  return (
    <div>
      <Greeting />
    </div>
  );
}

export default App;
```

---

## 🎨 Props - Passing Data to Components

**Props** (properties) memungkinkan kita mengirim data ke components.

### Basic Props

```javascript
// Child component menerima props
function Welcome(props) {
  return <h1>Hello, {props.name}!</h1>;
}

// Parent component mengirim props
function App() {
  return (
    <div>
      <Welcome name="John" />
      <Welcome name="Jane" />
      <Welcome name="Bob" />
    </div>
  );
}
```

### Multiple Props

```javascript
function UserProfile(props) {
  return (
    <div>
      <h2>{props.name}</h2>
      <p>Age: {props.age}</p>
      <p>City: {props.city}</p>
    </div>
  );
}

// Usage
<UserProfile name="John" age={25} city="Jakarta" />
```

### Destructuring Props (Recommended)

```javascript
// ✅ BETTER - Destructuring props
function UserProfile({ name, age, city }) {
  return (
    <div>
      <h2>{name}</h2>
      <p>Age: {age}</p>
      <p>City: {city}</p>
    </div>
  );
}

// Usage tetap sama
<UserProfile name="John" age={25} city="Jakarta" />
```

---

## 🎨 Styling Components

### Method 1: Inline Styles

```javascript
function Button({ label }) {
  return (
    <button
      style={{
        backgroundColor: '#007bff',
        color: 'white',
        padding: '10px 20px',
        border: 'none',
        borderRadius: '4px',
        cursor: 'pointer'
      }}
    >
      {label}
    </button>
  );
}
```

### Method 2: CSS Classes

```javascript
// Component
function Button({ label }) {
  return (
    <button className="btn-primary">
      {label}
    </button>
  );
}

// CSS (Button.css)
.btn-primary {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #0056b3;
}
```

---

## 💻 Practical Example: Card Component

Mari buat **Card Component** yang reusable:

```javascript
// src/components/Card.js

function Card({ title, content, imageUrl, footer }) {
  return (
    <div className="card">
      {imageUrl && (
        <img src={imageUrl} alt={title} className="card-image" />
      )}
      <div className="card-body">
        <h3 className="card-title">{title}</h3>
        <p className="card-content">{content}</p>
      </div>
      {footer && (
        <div className="card-footer">
          {footer}
        </div>
      )}
    </div>
  );
}

export default Card;
```

**CSS:**

```css
/* Card.css */
.card {
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  max-width: 300px;
  margin: 20px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.card-body {
  padding: 16px;
}

.card-title {
  margin: 0 0 12px 0;
  font-size: 1.25rem;
  color: #333;
}

.card-content {
  color: #666;
  line-height: 1.5;
}

.card-footer {
  padding: 12px 16px;
  background-color: #f8f9fa;
  border-top: 1px solid #ddd;
}
```

**Usage:**

```javascript
// src/App.js
import Card from './components/Card';

function App() {
  return (
    <div>
      <Card
        title="React Tutorial"
        content="Learn React from scratch with this comprehensive tutorial."
        imageUrl="/react-logo.png"
        footer={<button>Learn More</button>}
      />
      
      <Card
        title="JavaScript Basics"
        content="Master JavaScript fundamentals."
        imageUrl="/js-logo.png"
      />
    </div>
  );
}
```

---

## 🎓 Component Composition

Components bisa di-nest di dalam components lain:

```javascript
function App() {
  return (
    <div>
      <Header />
      <main>
        <Card title="Post 1" content="Content 1" />
        <Card title="Post 2" content="Content 2" />
        <Card title="Post 3" content="Content 3" />
      </main>
      <Footer />
    </div>
  );
}
```

---

## ⚠️ Common Mistakes

### 1. Not Capitalizing Component Names

```javascript
// ❌ SALAH - lowercase
function greeting() {
  return <h1>Hello</h1>;
}

// ✅ BENAR - PascalCase
function Greeting() {
  return <h1>Hello</h1>;
}
```

### 2. Modifying Props

```javascript
// ❌ SALAH - Jangan modify props
function Welcome(props) {
  props.name = "Modified"; // JANGAN LAKUKAN INI!
  return <h1>{props.name}</h1>;
}

// ✅ BENAR - Props read-only
function Welcome({ name }) {
  const displayName = name.toUpperCase();
  return <h1>{displayName}</h1>;
}
```

### 3. Forgetting Export

```javascript
// ❌ SALAH
function MyComponent() {
  return <div>Hello</div>;
}

// ✅ BENAR
function MyComponent() {
  return <div>Hello</div>;
}

export default MyComponent;
```

---

## 📝 Summary

| Concept | Description |
|---------|-------------|
| **Component** | Function that returns JSX |
| **Props** | Data passed to components |
| **Destructuring** | Clean way to access props |
| **Composition** | Nesting components together |

---

## 🧠 Quiz

**1. Bagaimana cara menerima props di component?**
- A) `this.props`
- B) Sebagai parameter function ✓
- C) `import props`
- D) `props.get()`

**2. Apa yang terjadi jika kita modify props?**
- A) Component akan error
- B) React akan warning di console ✓
- C) Tidak ada yang terjadi
- D) Component akan re-render

---

**Selamat!** 🎉 Kamu sudah membuat component pertama kamu!
MD;
    }

    private function getLaravelIntroductionContent(): string
    {
        return <<<'MD'
# What is Laravel?

## 🎯 Learning Objectives

1. Memahami apa itu Laravel dan mengapa populer
2. Mengetahui fitur-fitur utama Laravel
3. Memahami MVC architecture
4. Install Laravel pertama kali

---

## 📚 What is Laravel?

**Laravel** adalah framework PHP **open-source** yang diciptakan oleh **Taylor Otwell** pada tahun 2011. Laravel mengikuti arsitektur **MVC** (Model-View-Controller) dan bertujuan untuk membuat development PHP lebih menyenangkan dan produktif.

### Philosophy

> "Laravel is a web application framework with expressive, elegant syntax."

---

## 🚀 Why Laravel?

### 1. Elegant Syntax

```php
// ✅ Laravel - Clean & Readable
$users = User::where('active', true)
    ->orderBy('name')
    ->get();

// ❌ Plain PHP - Verbose
$users = [];
$result = mysqli_query($conn, "SELECT * FROM users WHERE active = 1 ORDER BY name");
while($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}
```

### 2. Built-in Features

| Feature | Description |
|---------|-------------|
| **Eloquent ORM** | Elegant database abstraction |
| **Blade Templates** | Powerful templating engine |
| **Artisan CLI** | Command-line tools |
| **Authentication** | Ready-to-use auth system |
| **Routing** | Simple & expressive routing |
| **Middleware** | HTTP request filtering |
| **Queue** | Background job processing |
| **Events** | Event-driven architecture |

---

## 🏗️ MVC Architecture

```
┌─────────────────────────────────────────────────────────┐
│                    USER REQUEST                         │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────┐
│  ROUTER  →  CONTROLLER  →  MODEL  →  DATABASE          │
│                     │                                   │
│                     ▼                                   │
│                 VIEW  →  HTML RESPONSE                  │
└─────────────────────────────────────────────────────────┘
```

### Components:

**Model** - Data layer
```php
// app/Models/User.php
class User extends Model {
    // Database interaction logic
}
```

**View** - Presentation layer
```blade
<!-- resources/views/welcome.blade.php -->
<h1>Hello, {{ $name }}</h1>
```

**Controller** - Business logic layer
```php
// app/Http/Controllers/UserController.php
public function index() {
    $users = User::all();
    return view('users.index', compact('users'));
}
```

---

## 💻 Installation

### Prerequisites

1. **PHP** >= 8.1
2. **Composer** (Dependency manager)
3. **Database** (MySQL, PostgreSQL, SQLite)

### Step-by-Step Installation

```bash
# 1. Install Laravel via Composer
composer create-project laravel/laravel my-app

# 2. Enter project directory
cd my-app

# 3. Start development server
php artisan serve

# App berjalan di:
# http://localhost:8000
```

### Verify Installation

Buka browser dan akses `http://localhost:8000`

Kamu akan melihat halaman welcome Laravel!

---

## 📁 Directory Structure

```
my-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/   # Your controllers ⭐
│   │   └── Middleware/    # Request filters
│   └── Models/            # Your models ⭐
├── bootstrap/             # App bootstrap files
├── config/                # Configuration files
├── database/
│   ├── migrations/        # Database schema ⭐
│   ├── seeders/           # Sample data ⭐
│   └── factories/         # Test data generators
├── public/                # Entry point (index.php)
├── resources/
│   ├── views/             # Blade templates ⭐
│   └── css/               # Stylesheets
├── routes/
│   ├── web.php            # Web routes ⭐
│   └── api.php            # API routes
├── storage/               # Logs, uploads, cache
├── tests/                 # Automated tests
└── vendor/                # Dependencies
```

---

## 💻 Your First Laravel App

### Create a Simple Route

Edit `routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Hello, Laravel!';
});

Route::get('/about', function () {
    return 'About Us - Laravel Tutorial';
});

Route::get('/contact', function () {
    return 'Contact Us';
});
```

### Create a Controller

```bash
# Generate controller with Artisan
php artisan make:controller HomeController
```

Edit `app/Http/Controllers/HomeController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    
    public function about()
    {
        return view('about');
    }
}
```

Add routes:

```php
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
```

---

## 🎓 Best Practices

### 1. Use Artisan CLI

```bash
# ✅ GOOD - Use Artisan
php artisan make:controller UserController
php artisan make:model Post
php artisan make:migration create_posts_table

# ❌ BAD - Manual creation
# Creating files manually is error-prone
```

### 2. Follow Naming Conventions

| Type | Convention | Example |
|------|-----------|---------|
| Controller | PascalCase + "Controller" | `UserController` |
| Model | Singular PascalCase | `User`, `Post` |
| Table | Plural snake_case | `users`, `posts` |
| Route | kebab-case | `/user-profile` |

### 3. Keep Controllers Thin

```php
// ❌ FAT Controller
public function store(Request $request) {
    // Validation
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8'
    ]);
    
    // Hash password
    $hashedPassword = Hash::make($validated['password']);
    
    // Create user
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $hashedPassword
    ]);
    
    // Send email
    Mail::to($user->email)->send(new WelcomeEmail($user));
    
    // Return response
    return response()->json($user, 201);
}

// ✅ THIN Controller with Form Request
public function store(StoreUserRequest $request) {
    $user = $request->createUser();
    $user->sendWelcomeEmail();
    
    return response()->json($user, 201);
}
```

---

## ⚠️ Common Mistakes

### 1. Not Using Eloquent

```php
// ❌ AVOID - Raw SQL
$users = DB::select('SELECT * FROM users WHERE active = ?', [1]);

// ✅ PREFER - Eloquent
$users = User::where('active', true)->get();
```

### 2. Business Logic in Routes

```php
// ❌ AVOID - Logic in routes
Route::post('/users', function (Request $request) {
    // 50 lines of business logic here...
});

// ✅ PREFER - Use controllers
Route::post('/users', [UserController::class, 'store']);
```

---

## 📝 Summary

| Concept | Description |
|---------|-------------|
| **Laravel** | PHP framework dengan elegant syntax |
| **MVC** | Model-View-Controller architecture |
| **Eloquent** | ORM untuk database interaction |
| **Artisan** | CLI tool untuk development |
| **Blade** | Templating engine |

---

## 🧠 Quiz

**1. Siapa pencipta Laravel?**
- A) Mark Zuckerberg
- B) Taylor Otwell ✓
- C) Rasmus Lerdorf
- D) Ryan Dahl

**2. Apa itu Eloquent?**
- A) Template engine
- B) ORM untuk database ✓
- C) CLI tool
- D) Authentication system

**3. Command untuk membuat controller?**
- A) `php artisan create:controller`
- B) `php artisan generate:controller`
- C) `php artisan make:controller` ✓
- D) `php artisan new:controller`

---

**Selamat!** 🎉 Kamu telah mempelajari dasar-dasar Laravel!
MD;
    }

    private function getLaravelDirectoryStructureContent(): string
    {
        return <<<'MD'
# Laravel Directory Structure

## 🎯 Learning Objectives

1. Memahami struktur folder Laravel
2. Mengetahui fungsi setiap directory
3. Membuat controller pertama
4. Membuat route sederhana

---

## 📁 Complete Directory Structure

```
laravel-app/
├── 📂 app/                    # Core application code
│   ├── 📂 Http/
│   │   ├── 📂 Controllers/    # ⭐ Your controllers
│   │   ├── 📂 Middleware/     # Request filters
│   │   └── Kernel.php
│   ├── 📂 Models/             # ⭐ Your models
│   ├── 📂 Providers/          # Service providers
│   └── Console/               # Artisan commands
│
├── 📂 bootstrap/              # App bootstrap files
│
├── 📂 config/                 # ⭐ Configuration files
│   ├── app.php
│   ├── database.php
│   └── ...
│
├── 📂 database/
│   ├── 📂 migrations/         # ⭐ Database schema
│   ├── 📂 seeders/            # ⭐ Sample data
│   └── 📂 factories/          # Test data
│
├── 📂 public/                 # ⭐ Entry point
│   ├── index.php
│   └── .htaccess
│
├── 📂 resources/
│   ├── 📂 views/              # ⭐ Blade templates
│   ├── 📂 css/
│   └── 📂 js/
│
├── 📂 routes/                 # ⭐ All routes
│   ├── web.php                # Web routes
│   ├── api.php                # API routes
│   └── console.php
│
├── 📂 storage/                # Logs, uploads
│   ├── app/
│   ├── framework/
│   └── logs/
│
├── 📂 tests/                  # Automated tests
│
└── 📂 vendor/                 # Dependencies
```

---

## ⭐ Important Directories Explained

### 1. `app/Http/Controllers/`

Tempat menyimpan **controllers** yang menangani request logic.

```php
// app/Http/Controllers/UserController.php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }
}
```

### 2. `app/Models/`

Tempat menyimpan **models** untuk database interaction.

```php
// app/Models/User.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password'];
    
    protected $hidden = ['password', 'remember_token'];
}
```

### 3. `routes/web.php`

Definisi **routes** untuk web application.

```php
// routes/web.php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Basic route
Route::get('/', function () {
    return view('welcome');
});

// Controller route
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
```

### 4. `resources/views/`

**Blade templates** untuk UI.

```blade
<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>All Users</h1>

<ul>
@foreach($users as $user)
    <li>{{ $user->name }} ({{ $user->email }})</li>
@endforeach
</ul>
@endsection
```

### 5. `database/migrations/`

**Database schema** definitions.

```php
// database/migrations/2024_01_01_000001_create_users_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
```

---

## 💻 Practical Exercise

### Create Your First Controller

**Step 1:** Generate controller dengan Artisan

```bash
php artisan make:controller HomeController
```

**Step 2:** Edit controller

```php
// app/Http/Controllers/HomeController.php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    
    public function about()
    {
        return view('about', [
            'name' => 'John Doe',
            'bio' => 'Laravel Developer'
        ]);
    }
}
```

**Step 3:** Add routes

```php
// routes/web.php
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
```

**Step 4:** Create view (optional)

```blade
<!-- resources/views/about.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>About</title>
</head>
<body>
    <h1>About Me</h1>
    <p>Name: {{ $name }}</p>
    <p>Bio: {{ $bio }}</p>
</body>
</html>
```

**Step 5:** Test

```bash
php artisan serve
# Visit: http://localhost:8000/about
```

---

## 🎓 Best Practices

### 1. Use Resource Controllers for CRUD

```bash
# Generate resource controller
php artisan make:controller PostController --resource
```

```php
// Automatically creates these methods:
public function index()   // List all posts
public function create()  // Show create form
public function store()   // Save new post
public function show()    // Show single post
public function edit()    // Show edit form
public function update()  // Update post
public function destroy() // Delete post
```

### 2. Group Related Routes

```php
// Group routes with common prefix
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
});
```

### 3. Named Routes

```php
// Define named route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Use in views
<a href="{{ route('about') }}">About</a>
```

---

## ⚠️ Common Mistakes

### 1. Putting Logic in Routes

```php
// ❌ AVOID
Route::get('/users', function () {
    $users = User::where('active', true)->get();
    foreach ($users as $user) {
        // complex logic...
    }
    return view('users', compact('users'));
});

// ✅ PREFER
Route::get('/users', [UserController::class, 'index']);
```

### 2. Not Using Type Hinting

```php
// ❌ AVOID
public function show($id) {
    $user = User::find($id);
    return view('users.show', compact('user'));
}

// ✅ PREFER
public function show(User $user) {
    return view('users.show', compact('user'));
}
```

---

## 📝 Summary

| Directory | Purpose |
|-----------|---------|
| `app/Http/Controllers` | Request handlers |
| `app/Models` | Database models |
| `routes/web.php` | Web routes |
| `resources/views` | Blade templates |
| `database/migrations` | Database schema |

---

## 🧠 Quiz

**1. Di folder manakah kita menyimpan Controller?**
- A) `app/Models`
- B) `app/Http/Controllers` ✓
- C) `routes`
- D) `resources/views`

**2. File apa yang berisi definisi routes?**
- A) `app.php`
- B) `web.php` ✓
- C) `index.php`
- D) `routes.php`

---

**Selamat!** 🎉 Kamu sekarang memahami struktur Laravel!
MD;
    }

    private function getLaravelRoutingContent(): string
    {
        return <<<'MD'
# Basic Routing in Laravel

## 🎯 Learning Objectives

1. Memahami konsep routing di Laravel
2. Membuat berbagai jenis routes
3. Route parameters dan constraints
4. Named routes dan URL generation

---

## 📚 What is Routing?

**Routing** adalah cara untuk menentukan bagaimana aplikasi merespons request ke URL tertentu.

```
Request → Router → Controller → Response
```

---

## 💻 Basic Routes

### GET Route

```php
// routes/web.php
Route::get('/', function () {
    return 'Hello, World!';
});

Route::get('/about', function () {
    return view('about');
});
```

### POST Route

```php
Route::post('/users', function (Request $request) {
    // Create new user
    return 'User created!';
});
```

### Multiple HTTP Verbs

```php
// GET - Retrieve
Route::get('/posts', [PostController::class, 'index']);

// POST - Create
Route::post('/posts', [PostController::class, 'store']);

// PUT/PATCH - Update
Route::put('/posts/{id}', [PostController::class, 'update']);

// DELETE - Delete
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
```

---

## 🔢 Route Parameters

### Required Parameters

```php
// Parameter wajib ada
Route::get('/users/{id}', function ($id) {
    return "User ID: {$id}";
});

// Multiple parameters
Route::get('/users/{userId}/posts/{postId}', function ($userId, $postId) {
    return "User {$userId}, Post {$postId}";
});
```

### Optional Parameters

```php
// Parameter optional dengan default value
Route::get('/users/{id?}', function ($id = null) {
    if ($id) {
        return "User ID: {$id}";
    }
    return "All Users";
});
```

### Parameters with Constraints

```php
// Hanya menerima angka
Route::get('/users/{id}', function ($id) {
    return "User: {$id}";
})->where('id', '[0-9]+');

// Hanya menerima alphanumeric
Route::get('/posts/{slug}', function ($slug) {
    return "Post: {$slug}";
})->where('slug', '[A-Za-z0-9-]+');
```

---

## 🏷️ Named Routes

Named routes memudahkan untuk generate URLs.

```php
// Define named route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Generate URL
$url = route('about'); // http://yoursite.com/about

// In Blade views
<a href="{{ route('about') }}">About Us</a>

// Named route with parameters
Route::get('/users/{id}', function ($id) {
    // ...
})->name('users.show');

// With parameters
$url = route('users.show', ['id' => 1]);
// http://yoursite.com/users/1
```

---

## 📁 Route Groups

### Middleware Group

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show']);
});
```

### Prefix Group

```php
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
});
// URLs: /admin/dashboard, /admin/users
```

### Combined

```php
Route::prefix('api')
    ->middleware('api')
    ->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
    });
```

---

## 💻 Practical Exercise

**Create complete CRUD routes for Blog:**

```php
// routes/web.php

use App\Http\Controllers\PostController;

// Resource controller (recommended)
Route::resource('posts', PostController::class);

// Or manual routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
```

---

## 🎓 Best Practices

### 1. Use Resource Controllers

```bash
php artisan make:controller PostController --resource
```

### 2. Use Named Routes

```php
// ✅ GOOD
return redirect()->route('posts.show', $post);

// ❌ BAD
return redirect('/posts/' . $post->id);
```

### 3. Group Related Routes

```php
Route::prefix('blog')->name('blog.')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
});
// Named routes: blog.posts.index, blog.categories.show, etc.
```

---

## 📝 Summary

| Method | Description |
|--------|-------------|
| `Route::get()` | GET request |
| `Route::post()` | POST request |
| `Route::put()` | PUT request |
| `Route::delete()` | DELETE request |
| `->name()` | Named route |
| `->middleware()` | Apply middleware |

---

## 🧠 Quiz

**1. HTTP method untuk GET route?**
- A) POST
- B) GET ✓
- C) PUT
- D) DELETE

**2. Bagaimana membuat named route?**
- A) `->name('route-name')` ✓
- B) `->named('route-name')`
- C) `Route::name()`
- D) `name: 'route-name'`

---

**Selamat!** 🎉 Kamu telah mempelajari routing di Laravel!
MD;
    }

    private function getHowWebWorksContent(): string
    {
        return <<<'MD'
# How the Web Works

## 🎯 Learning Objectives

1. Memahami client-server model
2. Mengetahui apa itu HTTP/HTTPS
3. Memahami request-response cycle
4. Membuat halaman HTML pertama

---

## 🌐 The Client-Server Model

### What is a Client?

**Client** adalah perangkat atau software yang **meminta** resources.

Examples:
- 🖥️ Web browsers (Chrome, Firefox, Safari)
- 📱 Mobile apps
- 💻 Desktop applications

### What is a Server?

**Server** adalah komputer yang **menyediakan** resources.

Examples:
- Web servers (Apache, Nginx)
- Database servers (MySQL, PostgreSQL)
- Application servers (Node.js, Laravel)

```
┌──────────┐                          ┌──────────┐
│  CLIENT  │ ─── HTTP Request ────→   │  SERVER  │
│ (Browser)│                          │ (Apache) │
│          │ ←── HTML Response ────   │          │
└──────────┘                          └──────────┘
```

---

## 📡 HTTP/HTTPS

### What is HTTP?

**HTTP** (HyperText Transfer Protocol) adalah protocol untuk komunikasi web.

### HTTP Request Structure

```
GET /index.html HTTP/1.1
Host: www.example.com
User-Agent: Mozilla/5.0
Accept: text/html
```

### HTTP Response Structure

```
HTTP/1.1 200 OK
Content-Type: text/html
Content-Length: 1234

<!DOCTYPE html>
<html>...</html>
```

### Common HTTP Methods

| Method | Description | Example |
|--------|-------------|---------|
| GET | Retrieve data | Load webpage |
| POST | Submit data | Submit form |
| PUT | Update data | Edit profile |
| DELETE | Remove data | Delete post |

### HTTP Status Codes

| Code | Meaning | Description |
|------|---------|-------------|
| 200 | OK | Success |
| 301 | Moved Permanently | Redirect |
| 400 | Bad Request | Invalid request |
| 403 | Forbidden | Access denied |
| 404 | Not Found | Page not found |
| 500 | Internal Server Error | Server error |

---

## 🔄 Request-Response Cycle

```
1. User types URL in browser
         ↓
2. Browser sends DNS query
         ↓
3. DNS returns server IP
         ↓
4. Browser sends HTTP request
         ↓
5. Server processes request
         ↓
6. Server sends HTTP response
         ↓
7. Browser renders HTML
         ↓
8. Page is displayed!
```

---

## 💻 Your First HTML Page

### Basic HTML Structure

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First Webpage</title>
</head>
<body>
    <h1>Hello, World!</h1>
    <p>Welcome to my website.</p>
</body>
</html>
```

### Explanation

| Tag | Description |
|-----|-------------|
| `<!DOCTYPE html>` | Declares HTML5 document |
| `<html>` | Root element |
| `<head>` | Metadata (not visible) |
| `<title>` | Page title (shown in tab) |
| `<body>` | Visible content |
| `<h1>` | Main heading |
| `<p>` | Paragraph |

---

## 💻 Practical Exercise

**Create a personal introduction page:**

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me</title>
</head>
<body>
    <header>
        <h1>John Doe</h1>
        <p>Web Developer | Student | Learner</p>
    </header>
    
    <main>
        <section>
            <h2>About Me</h2>
            <p>
                Hello! I'm John, a passionate web developer 
                from Jakarta, Indonesia.
            </p>
        </section>
        
        <section>
            <h2>My Skills</h2>
            <ul>
                <li>HTML & CSS</li>
                <li>JavaScript</li>
                <li>React</li>
                <li>Node.js</li>
            </ul>
        </section>
        
        <section>
            <h2>Contact</h2>
            <p>Email: john@example.com</p>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 John Doe. All rights reserved.</p>
    </footer>
</body>
</html>
```

---

## 🎓 Best Practices

### 1. Always Use Semantic HTML

```html
<!-- ✅ GOOD -->
<header>
    <nav>...</nav>
</header>
<main>
    <article>...</article>
</main>
<footer>...</footer>

<!-- ❌ BAD -->
<div class="header">
    <div class="nav">...</div>
</div>
<div class="main">
    <div class="content">...</div>
</div>
```

### 2. Use Meaningful Titles

```html
<!-- ✅ GOOD -->
<title>Learn Web Development - Complete Guide</title>

<!-- ❌ BAD -->
<title>Page 1</title>
```

### 3. Always Include Meta Tags

```html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn web development">
    <title>My Website</title>
</head>
```

---

## 📝 Summary

| Concept | Description |
|---------|-------------|
| **Client** | Requests resources (browser) |
| **Server** | Provides resources |
| **HTTP** | Communication protocol |
| **HTML** | Markup language for web pages |

---

## 🧠 Quiz

**1. Apa kepanjangan HTTP?**
- A) Hyper Text Markup Language
- B) HyperText Transfer Protocol ✓
- C) High Tech Modern Protocol
- D) Home Tool Transfer Protocol

**2. Status code untuk "Not Found"?**
- A) 200
- B) 301
- C) 404 ✓
- D) 500

---

**Selamat!** 🎉 Kamu telah mempelajari bagaimana web bekerja!
MD;
    }

    private function getHtmlStructureContent(): string
    {
        return <<<'MD'
# HTML Document Structure

## 🎯 Learning Objectives

1. Memahami struktur dokumen HTML5
2. Menggunakan semantic elements
3. Membuat struktur halaman yang proper

---

## 📚 HTML5 Semantic Elements

Semantic elements menjelaskan **makna** dari content mereka.

### Common Semantic Elements

```html
<header>    <!-- Header/heading of page or section -->
<nav>       <!-- Navigation links -->
<main>      <!-- Main content -->
<article>   <!-- Independent content -->
<section>   <!-- Thematic grouping -->
<aside>     <!-- Sidebar/related content -->
<footer>    <!-- Footer of page or section -->
```

---

## 💻 Complete HTML5 Structure

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page description">
    <title>Page Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Website Title</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <article>
            <h2>Article Title</h2>
            <section>
                <h3>Section 1</h3>
                <p>Content here...</p>
            </section>
        </article>
        
        <aside>
            <h3>Related Links</h3>
            <ul>
                <li><a href="#">Link 1</a></li>
            </ul>
        </aside>
    </main>
    
    <footer>
        <p>&copy; 2024 Website Name</p>
    </footer>
</body>
</html>
```

---

## 🎓 Best Practices

### 1. Use Semantic Elements

```html
<!-- ✅ GOOD -->
<article>
    <h1>Blog Post Title</h1>
    <p>Content...</p>
</article>

<!-- ❌ BAD -->
<div class="blog-post">
    <div class="title">Blog Post Title</div>
    <div class="content">Content...</div>
</div>
```

### 2. Proper Heading Hierarchy

```html
<!-- ✅ GOOD -->
<h1>Main Title</h1>
    <h2>Section</h2>
        <h3>Subsection</h3>

<!-- ❌ BAD -->
<h1>Main Title</h1>
    <h4>Section</h4>  <!-- Skip level -->
```

---

## 🧠 Quiz

**1. Element untuk navigation?**
- A) `<navigation>`
- B) `<nav>` ✓
- C) `<menu>`
- D) `<links>`

---

**Selamat!** 🎉 Kamu telah mempelajari struktur HTML!
MD;
    }

    private function getJavaScriptIntroContent(): string
    {
        return <<<'MD'
# Introduction to JavaScript

## 🎯 Learning Objectives

1. Memahami apa itu JavaScript
2. Menulis program JavaScript pertama
3. Memahami variabel dan tipe data

---

## 📚 What is JavaScript?

**JavaScript** adalah bahasa pemrograman untuk web yang:
- 🌐 Runs in browsers
- ⚡ Makes websites interactive
- 🔧 Can be used for backend (Node.js)

---

## 💻 Your First JavaScript

```javascript
// Output ke console
console.log("Hello, World!");

// Variables
let name = "John";
let age = 25;

// Output dengan variable
console.log(`Hello, ${name}! You are ${age} years old.`);

// Math operations
let sum = 10 + 5;
console.log("Sum:", sum);
```

---

## 🔢 Data Types

```javascript
// String
let text = "Hello";

// Number
let number = 42;
let decimal = 3.14;

// Boolean
let isActive = true;
let isDisabled = false;

// Null
let empty = null;

// Undefined
let notDefined;

// Object
let person = {
    name: "John",
    age: 25
};

// Array
let colors = ["red", "green", "blue"];
```

---

## 🧠 Quiz

**1. Cara menampilkan output?**
- A) `print()`
- B) `console.log()` ✓
- C) `echo()`

---

**Selamat!** 🎉
MD;
    }

    private function getVariablesContent(): string
    {
        return <<<'MD'
# Variables and Data Types

## 🎯 Learning Objectives

1. Deklarasi variabel dengan let, const, var
2. Memahami tipe data JavaScript

---

## 📦 Variable Declarations

```javascript
// let - bisa diubah
let name = "John";
name = "Jane"; // ✅ OK

// const - tidak bisa diubah
const PI = 3.14;
// PI = 3.15; // ❌ ERROR

// var - old way (avoid)
var old = "deprecated";
```

---

## 🧠 Quiz

**1. Keyword untuk constant?**
- A) `let`
- B) `var`
- C) `const` ✓

---

**Selamat!** 🎉
MD;
    }
}
