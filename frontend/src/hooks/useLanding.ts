import { useQuery } from '@tanstack/react-query'
import { landingApi } from '@/api/landing'

export function useLanding() {
  return useQuery({
    queryKey: ['landing'],
    queryFn: async () => {
      const { data } = await landingApi.getData()
      return data
    },
  })
}
