import { useMutation, useQuery } from '@tanstack/react-query'
import { paymentsApi } from '@/api/payments'

export function useCreatePayment() {
  return useMutation({
    mutationFn: paymentsApi.create,
  })
}

export function usePaymentStatus(orderId: string) {
  return useQuery({
    queryKey: ['payments', 'status', orderId],
    queryFn: async () => {
      const { data } = await paymentsApi.getStatus(orderId)
      return data.data
    },
    enabled: !!orderId,
  })
}

export function usePaymentHistory(page: number = 1) {
  return useQuery({
    queryKey: ['payments', 'history', page],
    queryFn: async () => {
      const { data } = await paymentsApi.getHistory(page)
      return data
    },
  })
}
