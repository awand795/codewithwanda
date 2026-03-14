<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CodeCompilerService
{
    protected $apiUrl = 'https://emkc.org/api/v2/piston';

    protected $supportedLanguages = [
        'javascript' => ['runtime' => 'javascript', 'version' => '18.15.0'],
        'python' => ['runtime' => 'python', 'version' => '3.10.0'],
        'java' => ['runtime' => 'java', 'version' => '15.0.2'],
        'cpp' => ['runtime' => 'cpp', 'version' => '10.2.0'],
        'c' => ['runtime' => 'c', 'version' => '10.2.0'],
        'csharp' => ['runtime' => 'csharp', 'version' => '6.12.0'],
        'php' => ['runtime' => 'php', 'version' => '8.2.3'],
        'ruby' => ['runtime' => 'ruby', 'version' => '3.0.1'],
        'go' => ['runtime' => 'go', 'version' => '1.16.2'],
        'rust' => ['runtime' => 'rust', 'version' => '1.68.2'],
        'swift' => ['runtime' => 'swift', 'version' => '5.3.3'],
        'kotlin' => ['runtime' => 'kotlin', 'version' => '1.6.10'],
        'typescript' => ['runtime' => 'typescript', 'version' => '5.0.3'],
        'html' => ['runtime' => 'html', 'version' => '1.0.0'],
        'css' => ['runtime' => 'css', 'version' => '1.0.0'],
    ];

    public function getSupportedLanguages(): array
    {
        return array_keys($this->supportedLanguages);
    }

    public function executeCode(string $language, string $code, ?string $input = null): array
    {
        if (!isset($this->supportedLanguages[$language])) {
            return [
                'success' => false,
                'error' => "Language '{$language}' is not supported",
            ];
        }

        $config = $this->supportedLanguages[$language];

        try {
            $response = Http::timeout(30)->post("{$this->apiUrl}/execute", [
                'language' => $config['runtime'],
                'version' => $config['version'],
                'files' => [
                    [
                        'content' => $code,
                    ],
                ],
                'stdin' => $input ?? '',
                'run_timeout' => 10000, // 10 seconds
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return [
                    'success' => true,
                    'output' => $result['run']['output'] ?? '',
                    'stderr' => $result['run']['stderr'] ?? '',
                    'exit_code' => $result['run']['code'] ?? null,
                    'execution_time' => $result['run']['time'] ?? '0ms',
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to execute code',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function runTests(string $language, string $code, array $testCases): array
    {
        $results = [];
        $passed = 0;
        $failed = 0;

        foreach ($testCases as $index => $testCase) {
            $input = $testCase['input'] ?? '';
            $expectedOutput = trim($testCase['expected_output'] ?? '');

            $result = $this->executeCode($language, $code, $input);

            $actualOutput = trim($result['output'] ?? '');
            $testPassed = $actualOutput === $expectedOutput;

            if ($testPassed) {
                $passed++;
            } else {
                $failed++;
            }

            $results[] = [
                'test_number' => $index + 1,
                'passed' => $testPassed,
                'input' => $input,
                'expected_output' => $expectedOutput,
                'actual_output' => $actualOutput,
                'error' => $result['error'] ?? null,
            ];
        }

        return [
            'success' => true,
            'total_tests' => count($testCases),
            'passed' => $passed,
            'failed' => $failed,
            'results' => $results,
        ];
    }

    public function getLanguageInfo(string $language): ?array
    {
        return $this->supportedLanguages[$language] ?? null;
    }
}
