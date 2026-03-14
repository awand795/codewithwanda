import api from './axios'
import type { User } from '@/types'

interface AuthResponse {
  user: User
  token: string
}

export const authApi = {
  register: (data: { name: string; email: string; password: string; password_confirmation: string }) =>
    api.post<AuthResponse>('/register', data),

  login: (data: { email: string; password: string }) =>
    api.post<AuthResponse>('/login', data),

  logout: () =>
    api.post('/logout'),

  getUser: () =>
    api.get<{ user: User }>('/user'),

  forgotPassword: (data: { email: string }) =>
    api.post('/forgot-password', data),

  resetPassword: (data: { token: string; email: string; password: string; password_confirmation: string }) =>
    api.post('/reset-password', data),
}
