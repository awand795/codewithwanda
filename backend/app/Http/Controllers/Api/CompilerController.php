<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CodeCompilerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompilerController extends Controller
{
    protected CodeCompilerService $compilerService;

    public function __construct(CodeCompilerService $compilerService)
    {
        $this->compilerService = $compilerService;
    }

    public function languages(): JsonResponse
    {
        $languages = [];
        foreach ($this->compilerService->getSupportedLanguages() as $lang) {
            $info = $this->compilerService->getLanguageInfo($lang);
            $languages[$lang] = $info;
        }

        return response()->json([
            'languages' => $languages,
        ]);
    }

    public function execute(Request $request): JsonResponse
    {
        $request->validate([
            'language' => 'required|string|in:' . implode(',', $this->compilerService->getSupportedLanguages()),
            'code' => 'required|string',
            'input' => 'nullable|string',
        ]);

        $result = $this->compilerService->executeCode(
            $request->language,
            $request->code,
            $request->input
        );

        return response()->json($result);
    }

    public function test(Request $request): JsonResponse
    {
        $request->validate([
            'language' => 'required|string|in:' . implode(',', $this->compilerService->getSupportedLanguages()),
            'code' => 'required|string',
            'test_cases' => 'required|array|min:1',
            'test_cases.*.input' => 'nullable|string',
            'test_cases.*.expected_output' => 'required|string',
        ]);

        $result = $this->compilerService->runTests(
            $request->language,
            $request->code,
            $request->test_cases
        );

        return response()->json($result);
    }
}
