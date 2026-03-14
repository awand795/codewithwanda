import api from '../axios'
import type { Category } from '@/types'

export const adminCategoriesApi = {
  getAll: () =>
    api.get<{ data: Category[] }>('/admin/categories'),

  getById: (id: number) =>
    api.get<{ data: Category }>(`/admin/categories/${id}`),

  create: (data: Partial<Category>) =>
    api.post<{ data: Category }>('/admin/categories', data),

  update: (id: number, data: Partial<Category>) =>
    api.put<{ data: Category }>(`/admin/categories/${id}`, data),

  delete: (id: number) =>
    api.delete<{ message: string }>(`/admin/categories/${id}`),
}
