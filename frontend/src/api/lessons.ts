import api from './axios'
import type { Lesson } from '@/types'

export const lessonsApi = {
  getBySlug: (slug: string) =>
    api.get<{ data: Lesson }>(`/lessons/${slug}`),
}
