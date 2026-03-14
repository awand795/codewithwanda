import { BrowserRouter, Routes, Route } from 'react-router-dom'
import { QueryClient, QueryClientProvider } from '@tanstack/react-query'
import AppLayout from '@/components/layout/AppLayout'
import AdminLayout from '@/components/layout/AdminLayout'
import ProtectedRoute from '@/components/auth/ProtectedRoute'
import AdminProtectedRoute from '@/components/admin/AdminProtectedRoute'
import LandingPage from '@/pages/LandingPage'
import LoginPage from '@/pages/LoginPage'
import RegisterPage from '@/pages/RegisterPage'
import ForgotPasswordPage from '@/pages/ForgotPasswordPage'
import ResetPasswordPage from '@/pages/ResetPasswordPage'
import CategoriesPage from '@/pages/CategoriesPage'
import CoursesPage from '@/pages/CoursesPage'
import CourseDetailPage from '@/pages/CourseDetailPage'
import LessonPage from '@/pages/LessonPage'
import DashboardPage from '@/pages/DashboardPage'
import PaymentHistoryPage from '@/pages/PaymentHistoryPage'
import NotFoundPage from '@/pages/NotFoundPage'
import AdminLoginPage from '@/pages/admin/AdminLoginPage'
import AdminDashboardPage from '@/pages/admin/AdminDashboardPage'
import AdminCoursesPage from '@/pages/admin/AdminCoursesPage'
import AdminCourseFormPage from '@/pages/admin/AdminCourseFormPage'
import AdminCategoriesPage from '@/pages/admin/AdminCategoriesPage'
import CoursePlayerPage from '@/pages/CoursePlayerPage'

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      staleTime: 5 * 60 * 1000,
      retry: 1,
    },
  },
})

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <BrowserRouter>
        <Routes>
          {/* Public & User routes */}
          <Route element={<AppLayout />}>
            <Route path="/" element={<LandingPage />} />
            <Route path="/login" element={<LoginPage />} />
            <Route path="/register" element={<RegisterPage />} />
            <Route path="/forgot-password" element={<ForgotPasswordPage />} />
            <Route path="/reset-password" element={<ResetPasswordPage />} />
            <Route path="/categories" element={<CategoriesPage />} />
            <Route path="/courses" element={<CoursesPage />} />
            <Route path="/courses/:slug" element={<CourseDetailPage />} />
            <Route path="/courses/:slug/learn/:lessonSlug" element={<CoursePlayerPage />} />

            <Route element={<ProtectedRoute />}>
              <Route path="/lessons/:slug" element={<LessonPage />} />
              <Route path="/dashboard" element={<DashboardPage />} />
              <Route path="/payments" element={<PaymentHistoryPage />} />
            </Route>

            <Route path="*" element={<NotFoundPage />} />
          </Route>

          {/* Admin routes */}
          <Route path="/admin/login" element={<AdminLoginPage />} />
          
          <Route element={<AdminLayout />}>
            <Route element={<AdminProtectedRoute />}>
              <Route path="/admin/dashboard" element={<AdminDashboardPage />} />
              <Route path="/admin/courses" element={<AdminCoursesPage />} />
              <Route path="/admin/courses/new" element={<AdminCourseFormPage />} />
              <Route path="/admin/courses/:id/edit" element={<AdminCourseFormPage />} />
              <Route path="/admin/categories" element={<AdminCategoriesPage />} />
            </Route>
          </Route>
        </Routes>
      </BrowserRouter>
    </QueryClientProvider>
  )
}

export default App
