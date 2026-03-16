# CodeWithWanda - Sistem Pembelajaran Web

Platform e-learning full-stack modern yang dibangun dengan Laravel 12 dan React 19, dirancang untuk menghadirkan kursus online interaktif dan melacak kemajuan siswa.

## 🚀 Tech Stack

### Backend
- **Laravel 12** - Framework PHP 8.2+
- **Laravel Sanctum** - Autentikasi API
- **Midtrans** - Integrasi payment gateway
- **SQLite** - Database (default)
- **Laravel Sail** - Environment development Docker

### Frontend
- **React 19** - Library UI
- **TypeScript** - Type safety
- **React Router** - Routing client-side
- **TanStack Query** - Fetching & caching data
- **Zustand** - State management
- **Tailwind CSS 4** - Styling
- **Lucide React** - Icons
- **Axios** - HTTP client
- **Vite** - Build tool

## 📁 Struktur Project

```
Web Learning System/
├── backend/                 # Backend Laravel API
│   ├── app/
│   │   ├── Http/           # Controllers & middleware
│   │   ├── Models/         # Eloquent models
│   │   ├── Providers/      # Service providers
│   │   └── Services/       # Business logic
│   ├── config/             # File konfigurasi
│   ├── database/
│   │   ├── migrations/     # Migrasi database
│   │   ├── factories/      # Model factories
│   │   └── seeders/        # Database seeders
│   └── routes/             # Routes API
│
└── frontend/               # Frontend React
    ├── src/
    │   ├── api/           # Integrasi API
    │   ├── components/    # Komponen reusable
    │   ├── hooks/         # Custom React hooks
    │   ├── pages/         # Komponen halaman
    │   ├── stores/        # Zustand stores
    │   └── types/         # TypeScript types
    └── public/            # Static assets
```

## 📚 Fitur Utama

### Manajemen Kursus
- **Categories** - Organisasi kursus berdasarkan topik
- **Courses** - Wadah konten pembelajaran utama
- **Modules** - Memecah kursus menjadi beberapa bagian
- **Lessons** - Unit pembelajaran individual
- **Prerequisites** - Menentukan dependensi lesson

### Pelacakan Kemajuan Pengguna
- Lacak status penyelesaian untuk setiap lesson
- Monitor kemajuan keseluruhan kursus
- Penegakan prerequisite untuk pembelajaran berurutan

### Integrasi Pembayaran
- Payment gateway Midtrans
- Manajemen transaksi
- Pemrosesan pembayaran yang aman

### Role Pengguna
- Role student untuk pelajar
- Kapabilitas Instructor/Admin
- Dukungan avatar untuk profil pengguna

## 🛠️ Instalasi & Setup

### Prerequisites
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js 18+ dan npm
- SQLite (atau MySQL/PostgreSQL)

### Setup Backend

```bash
cd backend

# Install dependencies PHP
composer install

# Copy file environment dan generate app key
cp .env.example .env
php artisan key:generate

# Jalankan migrations
php artisan migrate

# (Opsional) Seed database
php artisan db:seed

# Jalankan development server
composer dev
```

### Setup Frontend

```bash
cd frontend

# Install dependencies Node
npm install

# Copy file environment jika diperlukan
cp .env.example .env

# Jalankan development server
npm run dev
```

### Setup Cepat (Backend)

Gunakan script composer untuk setup otomatis:

```bash
cd backend
composer run setup
```

## 🔧 Script Development

### Backend
```bash
# Jalankan development server dengan hot reload
composer run dev

# Jalankan tests
composer run test

# Hapus configuration cache
php artisan config:clear

# Jalankan database migrations
php artisan migrate

# Seed database
php artisan db:seed
```

### Frontend
```bash
# Development server dengan HMR
npm run dev

# Build production
npm run build

# Lint code
npm run lint

# Preview build production
npm run preview
```

## 🗄️ Schema Database

### Tabel Utama
- `users` - Akun pengguna dengan roles dan avatars
- `categories` - Kategori kursus
- `courses` - Penawaran kursus
- `modules` - Modul/bagian kursus
- `lessons` - Lesson individual
- `lesson_prerequisites` - Dependensi lesson
- `user_progress` - Pelacakan kemajuan pembelajaran
- `transactions` - Catatan pembayaran
- `cache`, `jobs`, `sessions` - Tabel sistem Laravel

## 🔐 Environment Variables

### Backend (.env)
```env
APP_NAME=CodeWithWanda
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# Atau gunakan MySQL/PostgreSQL:
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=codewithwanda
# DB_USERNAME=root
# DB_PASSWORD=

# Midtrans Payment Gateway
MIDTRANS_SERVER_KEY=
MIDTRANS_CLIENT_KEY=
MIDTRANS_IS_PRODUCTION=false
```

### Frontend (.env)
```env
VITE_API_URL=http://localhost:8000/api
```

## 🧪 Testing

```bash
# Backend tests
cd backend
composer run test

# Frontend tests (jika dikonfigurasi)
cd frontend
npm test
```

## 📝 API Endpoints

> Dokumentasi untuk API endpoints akan tersedia di `/api/documentation` ketika menggunakan Laravel Sanctum dengan OpenAPI/Scribe.

## 🚀 Deployment

### Backend
1. Set `APP_DEBUG=false` di `.env`
2. Jalankan `composer install --optimize-autoloader --no-dev`
3. Jalankan `php artisan config:cache`
4. Jalankan `php artisan route:cache`
5. Jalankan `php artisan migrate --force`

### Frontend
1. Build untuk production: `npm run build`
2. Serve folder `dist` melalui web server Anda

## 🤝 Contributing

1. Fork repository
2. Buat branch feature (`git checkout -b feature/amazing-feature`)
3. Commit perubahan Anda (`git commit -m 'Add amazing feature'`)
4. Push ke branch (`git push origin feature/amazing-feature`)
5. Buka Pull Request

## 📄 License

Project ini adalah proprietary software yang dikembangkan untuk CodeWithWanda.

## 👥 Team

Dibangun dengan ❤️ oleh Tim Development CodeWithWanda

## 🔑 Default User Accounts

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

### Admin Account
```
Email: admin@example.com
Password: password
Role: admin
```
**Akses**: Dapat mengakses SEMUA lesson dan course tanpa perlu purchase

### Premium User Account
```
Email: premium@example.com
Password: password
Role: premium
```
**Akses**: Dapat mengakses course premium yang sudah dibeli

### Free User Account
```
Email: user@example.com
Password: password
Role: free
```
**Akses**: Hanya dapat mengakses free preview lessons

> ⚠️ **Penting**: Jangan gunakan kredensial ini di production. Selalu ubah password default setelah deployment.

---

**Selamat Belajar! 🎓**
"# codewithwanda" 
