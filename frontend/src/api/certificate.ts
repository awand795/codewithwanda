import api from './axios'
import type { Certificate, CertificateEligibility } from '@/types'

export const certificateApi = {
  checkEligibility: (courseId: number) =>
    api.get<CertificateEligibility>(`/courses/${courseId}/certificate/check`),

  getCertificate: (courseId: number) =>
    api.get<{ has_certificate: boolean; certificate?: Certificate; eligibility?: CertificateEligibility }>(`/courses/${courseId}/certificate`),

  claimCertificate: (courseId: number) =>
    api.post<{ message: string; certificate: Certificate }>(`/courses/${courseId}/certificate`),

  downloadCertificate: (courseId: number) =>
    api.get(`/courses/${courseId}/certificate/download`, {
      responseType: 'blob',
    }),
}
