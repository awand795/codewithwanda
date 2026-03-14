import api from './axios'
import type { Course, PaginatedResponse } from '@/types'

interface CourseFilters {
  category?: string
  difficulty?: string
  is_premium?: boolean
  search?: string
  per_page?: number
  page?: number
}

export const coursesApi = {
  getAll: (filters?: CourseFilters) =>
    api.get<PaginatedResponse<Course>>('/courses', { params: filters }),

  getBySlug: (slug: string) =>
    api.get<{ data: Course }>(`/courses/${slug}`),
}
