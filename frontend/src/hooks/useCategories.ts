import { useQuery } from '@tanstack/react-query'
import { categoriesApi } from '@/api/categories'

export function useCategories() {
  return useQuery({
    queryKey: ['categories'],
    queryFn: async () => {
      const { data } = await categoriesApi.getAll()
      return data.data
    },
  })
}

export function useCategory(slug: string) {
  return useQuery({
    queryKey: ['categories', slug],
    queryFn: async () => {
      const { data } = await categoriesApi.getBySlug(slug)
      return data.data
    },
    enabled: !!slug,
  })
}
