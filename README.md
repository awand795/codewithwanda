# CodeWithWanda - Web Learning System

A modern, full-stack e-learning platform built with Laravel 12 and React 19, designed to deliver interactive online courses and track student progress.

## 🚀 Tech Stack

### Backend
- **Laravel 12** - PHP 8.2+ framework
- **Laravel Sanctum** - API authentication
- **Midtrans** - Payment gateway integration
- **SQLite** - Database (default)
- **Laravel Sail** - Docker development environment

### Frontend
- **React 19** - UI library
- **TypeScript** - Type safety
- **React Router** - Client-side routing
- **TanStack Query** - Data fetching & caching
- **Zustand** - State management
- **Tailwind CSS 4** - Styling
- **Lucide React** - Icons
- **Axios** - HTTP client
- **Vite** - Build tool

## 📁 Project Structure

```
Web Learning System/
├── backend/                 # Laravel API backend
│   ├── app/
│   │   ├── Http/           # Controllers & middleware
│   │   ├── Models/         # Eloquent models
│   │   ├── Providers/      # Service providers
│   │   └── Services/       # Business logic
│   ├── config/             # Configuration files
│   ├── database/
│   │   ├── migrations/     # Database migrations
│   │   ├── factories/      # Model factories
│   │   └── seeders/        # Database seeders
│   └── routes/             # API routes
│
└── frontend/               # React frontend
    ├── src/
    │   ├── api/           # API integration
    │   ├── components/    # Reusable components
    │   ├── hooks/         # Custom React hooks
    │   ├── pages/         # Page components
    │   ├── stores/        # Zustand stores
    │   └── types/         # TypeScript types
    └── public/            # Static assets
```

## 📚 Core Features

### Course Management
- **Categories** - Organize courses by topic
- **Courses** - Main learning content containers
- **Modules** - Break down courses into sections
- **Lessons** - Individual learning units
- **Prerequisites** - Define lesson dependencies

### User Progress Tracking
- Track completion status for each lesson
- Monitor overall course progress
- Prerequisite enforcement for sequential learning

### Payment Integration
- Midtrans payment gateway
- Transaction management
- Secure payment processing

### User Roles
- Student role for learners
- Instructor/Admin capabilities
- Avatar support for user profiles

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- SQLite (or MySQL/PostgreSQL)

### Backend Setup

```bash
cd backend

# Install PHP dependencies
composer install

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# (Optional) Seed the database
php artisan db:seed

# Start development server
composer dev
```

### Frontend Setup

```bash
cd frontend

# Install Node dependencies
npm install

# Copy environment file if needed
cp .env.example .env

# Start development server
npm run dev
```

### Quick Setup (Backend)

Use the composer script for automated setup:

```bash
cd backend
composer run setup
```

## 🔧 Development Scripts

### Backend
```bash
# Run development server with hot reload
composer run dev

# Run tests
composer run test

# Clear configuration cache
php artisan config:clear

# Run database migrations
php artisan migrate

# Seed database
php artisan db:seed
```

### Frontend
```bash
# Development server with HMR
npm run dev

# Production build
npm run build

# Lint code
npm run lint

# Preview production build
npm run preview
```

## 🗄️ Database Schema

### Main Tables
- `users` - User accounts with roles and avatars
- `categories` - Course categories
- `courses` - Course offerings
- `modules` - Course modules/sections
- `lessons` - Individual lessons
- `lesson_prerequisites` - Lesson dependencies
- `user_progress` - Learning progress tracking
- `transactions` - Payment records
- `cache`, `jobs`, `sessions` - Laravel system tables

## 🔐 Environment Variables

### Backend (.env)
```env
APP_NAME=CodeWithWanda
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# Or use MySQL/PostgreSQL:
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

# Frontend tests (if configured)
cd frontend
npm test
```

## 📝 API Endpoints

> Documentation for API endpoints will be available at `/api/documentation` when using Laravel Sanctum with OpenAPI/Scribe.

## 🚀 Deployment

### Backend
1. Set `APP_DEBUG=false` in `.env`
2. Run `composer install --optimize-autoloader --no-dev`
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Run `php artisan migrate --force`

### Frontend
1. Build for production: `npm run build`
2. Serve the `dist` folder via your web server

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is proprietary software developed for CodeWithWanda.

## 👥 Team

Built with ❤️ by the CodeWithWanda Development Team

---

**Happy Learning! 🎓**
"# codewithwanda" 
