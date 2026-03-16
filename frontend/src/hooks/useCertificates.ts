import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query'
import { certificateApi } from '@/api/certificate'
import { useToast } from '@/hooks/use-toast'

export function useCertificate(courseId: number) {
  const { toast } = useToast()

  return useQuery({
    queryKey: ['certificate', courseId],
    queryFn: async () => {
      const { data } = await certificateApi.getCertificate(courseId)
      return data
    },
    enabled: !!courseId,
  })
}

export function useClaimCertificate(courseId: number) {
  const queryClient = useQueryClient()
  const { toast } = useToast()

  return useMutation({
    mutationFn: () => certificateApi.claimCertificate(courseId),
    onSuccess: (response) => {
      queryClient.invalidateQueries({ queryKey: ['certificate', courseId] })
      toast({
        title: 'Sertifikat Berhasil!',
        description: response.data.message,
      })
    },
    onError: (error: any) => {
      toast({
        title: 'Gagal Mengklaim Sertifikat',
        description: error.response?.data?.message || 'Terjadi kesalahan',
        variant: 'destructive',
      })
    },
  })
}

export function useCertificateEligibility(courseId: number) {
  return useQuery({
    queryKey: ['certificate-eligibility', courseId],
    queryFn: async () => {
      const { data } = await certificateApi.checkEligibility(courseId)
      return data
    },
    enabled: !!courseId,
  })
}
