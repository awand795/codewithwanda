import { useQuery } from '@tanstack/react-query'
import { lessonsApi } from '@/api/lessons'
import type { AxiosError } from 'axios'

export function useLesson(slug: string) {
  return useQuery({
    queryKey: ['lessons', slug],
    queryFn: async () => {
      const { data } = await lessonsApi.getBySlug(slug)
      return data.data
    },
    enabled: !!slug,
    retry: (failureCount, error: AxiosError) => {
      if (error.response?.status === 403) return false
      return failureCount < 3
    },
  })
}
