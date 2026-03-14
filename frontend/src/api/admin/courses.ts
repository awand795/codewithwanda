import api from '../axios'
import type { Course, PaginatedResponse } from '@/types'

interface AdminCourseFilters {
  category_id?: number
  is_published?: boolean
  search?: string
  per_page?: number
  page?: number
  sort_by?: string
  sort_dir?: 'asc' | 'desc'
}

export const adminCoursesApi = {
  getAll: (filters?: AdminCourseFilters) =>
    api.get<PaginatedResponse<Course>>('/admin/courses', { params: filters }),

  getById: (id: number) =>
    api.get<{ data: Course }>(`/admin/courses/${id}`),

  create: (data: Partial<Course>) =>
    api.post<{ data: Course }>('/admin/courses', data),

  update: (id: number, data: Partial<Course>) =>
    api.put<{ data: Course }>(`/admin/courses/${id}`, data),

  delete: (id: number) =>
    api.delete<{ message: string }>(`/admin/courses/${id}`),

  bulkPublish: (courseIds: number[]) =>
    api.post<{ message: string }>('/admin/courses/bulk-publish', { course_ids: courseIds }),

  bulkUnpublish: (courseIds: number[]) =>
    api.post<{ message: string }>('/admin/courses/bulk-unpublish', { course_ids: courseIds }),
}
