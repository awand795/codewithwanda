import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query'
import { adminCategoriesApi } from '@/api/admin/categories'
import type { Category } from '@/types'

export function useAdminCategories() {
  return useQuery({
    queryKey: ['admin-categories'],
    queryFn: async () => {
      const { data } = await adminCategoriesApi.getAll()
      return data.data
    },
  })
}

export function useAdminCategory(id: number | null) {
  return useQuery({
    queryKey: ['admin-category', id],
    queryFn: async () => {
      if (!id) return null
      const { data } = await adminCategoriesApi.getById(id)
      return data.data
    },
    enabled: !!id,
  })
}

export function useCreateCategory() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (data: Partial<Category>) => adminCategoriesApi.create(data),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['admin-categories'] })
    },
  })
}

export function useUpdateCategory() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: ({ id, data }: { id: number; data: Partial<Category> }) =>
      adminCategoriesApi.update(id, data),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['admin-categories'] })
    },
  })
}

export function useDeleteCategory() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (id: number) => adminCategoriesApi.delete(id),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['admin-categories'] })
    },
  })
}
