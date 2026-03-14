import { useQuery, useMutation } from '@tanstack/react-query'
import { compilerApi } from '@/api/compiler'

export function useCompilerLanguages() {
  return useQuery({
    queryKey: ['compiler-languages'],
    queryFn: async () => {
      const { data } = await compilerApi.getLanguages()
      return data.languages
    },
  })
}

export function useExecuteCode() {
  return useMutation({
    mutationFn: ({ language, code, input }: { language: string; code: string; input?: string }) =>
      compilerApi.executeCode(language, code, input),
  })
}

export function useRunTests() {
  return useMutation({
    mutationFn: ({ language, code, testCases }: { language: string; code: string; testCases: Array<{ input: string; expected_output: string }> }) =>
      compilerApi.runTests(language, code, testCases),
  })
}
