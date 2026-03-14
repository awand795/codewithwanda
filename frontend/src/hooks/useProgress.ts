import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query'
import { progressApi } from '@/api/progress'

export function useMarkLessonComplete() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: progressApi.markComplete,
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['progress'] })
      queryClient.invalidateQueries({ queryKey: ['lessons'] })
    },
  })
}

export function useCourseProgress(courseId: number) {
  return useQuery({
    queryKey: ['progress', 'course', courseId],
    queryFn: async () => {
      const { data } = await progressApi.getCourseProgress(courseId)
      return data.data
    },
    enabled: !!courseId,
  })
}

export function useCourseSummary(courseId: number) {
  return useQuery({
    queryKey: ['progress', 'summary', courseId],
    queryFn: async () => {
      const { data } = await progressApi.getCourseSummary(courseId)
      return data.data
    },
    enabled: !!courseId,
  })
}
