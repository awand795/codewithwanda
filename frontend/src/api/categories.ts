import api from './axios'
import type { Category } from '@/types'

export const categoriesApi = {
  getAll: () =>
    api.get<{ data: Category[] }>('/categories'),

  getBySlug: (slug: string) =>
    api.get<{ data: Category }>(`/categories/${slug}`),
}
