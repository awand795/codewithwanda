import api from './axios'
import type { UserProgress, CourseProgress } from '@/types'

export const progressApi = {
  markComplete: (lessonId: number) =>
    api.post<{ data: UserProgress }>(`/progress/${lessonId}`),

  getCourseProgress: (courseId: number) =>
    api.get<{ data: UserProgress[] }>(`/progress/course/${courseId}`),

  getCourseSummary: (courseId: number) =>
    api.get<{ data: CourseProgress }>(`/progress/course/${courseId}/summary`),
}
