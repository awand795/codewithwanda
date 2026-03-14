import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query'
import { adminCoursesApi } from '@/api/admin/courses'
import type { Course } from '@/types'

interface AdminCourseFilters {
  category_id?: number
  is_published?: boolean
  search?: string
  per_page?: number
  page?: number
  sort_by?: string
  sort_dir?: 'asc' | 'desc'
}

export function useAdminCourses(filters?: AdminCourseFilters) {
  return useQuery({
    queryKey: ['admin-courses', filters],
    queryFn: async () => {
      const { data } = await adminCoursesApi.getAll(filters)
      return data
    },
  })
}

export function useAdminCourse(id: number | null) {
  return useQuery({
    queryKey: ['admin-course', id],
    queryFn: async () => {
      if (!id) return null
      const { data } = await adminCoursesApi.getById(id)
      return data.data
    },
    enabled: !!id,
  })
}

export function useCreateCourse() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (data: Partial<Course>) => adminCoursesApi.create(data),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['admin-courses'] })
    },
  })
}

export function useUpdateCourse() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: ({ id, data }: { id: number; data: Partial<Course> }) =>
      adminCoursesApi.update(id, data),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['admin-courses'] })
    },
  })
}

export function useDeleteCourse() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (id: number) => adminCoursesApi.delete(id),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['admin-courses'] })
    },
  })
}

export function useBulkPublish() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (courseIds: number[]) => adminCoursesApi.bulkPublish(courseIds),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['admin-courses'] })
    },
  })
}

export function useBulkUnpublish() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (courseIds: number[]) => adminCoursesApi.bulkUnpublish(courseIds),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['admin-courses'] })
    },
  })
}
