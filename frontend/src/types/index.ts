export interface User {
  id: number
  name: string
  email: string
  role: 'free' | 'premium' | 'admin'
  avatar: string | null
  created_at: string
}

export interface Category {
  id: number
  name: string
  slug: string
  description: string | null
  icon: string | null
  order: number
  courses_count?: number
  courses?: Course[]
}

export interface Course {
  id: number
  category_id: number
  title: string
  slug: string
  description: string | null
  thumbnail: string | null
  price: number
  is_premium: boolean
  difficulty: 'beginner' | 'intermediate' | 'advanced'
  is_published: boolean
  order: number
  category?: Category
  modules?: Module[]
  lessons_count?: number
  modules_count?: number
}

export interface Module {
  id: number
  course_id: number
  title: string
  description: string | null
  order: number
  lessons?: LessonSummary[]
  lessons_count?: number
}

export interface LessonSummary {
  id: number
  title: string
  slug: string
  duration_minutes: number
  is_free_preview: boolean
  order: number
  content_html?: string
  starter_code?: string
  exercise_description?: string
  programming_language?: string
  test_cases?: Array<{ input: string; expected_output: string }>
}

export interface Lesson extends LessonSummary {
  module_id: number
  content: string | null
  video_url: string | null
  has_access: boolean
  prerequisites?: LessonSummary[]
  content_html?: string
  starter_code?: string
  exercise_description?: string
  programming_language?: string
  test_cases?: Array<{ input: string; expected_output: string }>
}

export interface UserProgress {
  id: number
  user_id: number
  lesson_id: number
  completed_at: string
  lesson?: LessonSummary
}

export interface Transaction {
  id: number
  order_id: string
  amount: number
  payment_status: 'pending' | 'settlement' | 'expire' | 'cancel' | 'deny' | 'refund'
  payment_type: string | null
  paid_at: string | null
  created_at: string
  course?: Course
}

export interface PaginatedResponse<T> {
  data: T[]
  meta: {
    current_page: number
    last_page: number
    per_page: number
    total: number
  }
}

export interface LandingData {
  featured_courses: Course[]
  categories: Category[]
  stats: {
    total_courses: number
    total_lessons: number
    total_students: number
    total_categories: number
  }
}

export interface CourseProgress {
  total: number
  completed: number
  percentage: number
}
