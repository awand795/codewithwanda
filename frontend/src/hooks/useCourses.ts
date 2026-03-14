import { useQuery } from '@tanstack/react-query'
import { coursesApi } from '@/api/courses'

interface CourseFilters {
  category?: string
  difficulty?: string
  is_premium?: boolean
  search?: string
  per_page?: number
  page?: number
}

export function useCourses(filters?: CourseFilters) {
  return useQuery({
    queryKey: ['courses', filters],
    queryFn: async () => {
      const { data } = await coursesApi.getAll(filters)
      return data
    },
  })
}

export function useCourse(slug: string) {
  return useQuery({
    queryKey: ['courses', slug],
    queryFn: async () => {
      const { data } = await coursesApi.getBySlug(slug)
      return data.data
    },
    enabled: !!slug,
  })
}
