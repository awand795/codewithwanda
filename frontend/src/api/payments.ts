import api from './axios'
import type { Transaction, PaginatedResponse } from '@/types'

export const paymentsApi = {
  create: (courseId: number) =>
    api.post<{ snap_token: string; transaction: Transaction }>('/payments/create', { course_id: courseId }),

  getStatus: (orderId: string) =>
    api.get<{ data: Transaction }>(`/payments/status/${orderId}`),

  getHistory: (page?: number) =>
    api.get<PaginatedResponse<Transaction>>('/payments/history', { params: { page } }),
}
