import api from './axios'
import type { LandingData } from '@/types'

export const landingApi = {
  getData: () =>
    api.get<LandingData>('/landing'),
}
