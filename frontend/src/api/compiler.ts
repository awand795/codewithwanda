import api from './axios'

export const compilerApi = {
  getLanguages: () =>
    api.get('/compiler/languages'),

  executeCode: (language: string, code: string, input?: string) =>
    api.post('/compiler/execute', { language, code, input }),

  runTests: (language: string, code: string, testCases: Array<{ input: string; expected_output: string }>) =>
    api.post('/compiler/test', { language, code, test_cases: testCases }),
}
