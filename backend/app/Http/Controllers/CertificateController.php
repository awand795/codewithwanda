<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCompletion;
use App\Services\CertificateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CertificateController extends Controller
{
    public function __construct(
        private CertificateService $certificateService,
    ) {}

    /**
     * Check if user can claim certificate
     */
    public function checkEligibility(Request $request, int $courseId): JsonResponse
    {
        $user = $request->user();
        $course = Course::findOrFail($courseId);

        $eligibility = $this->certificateService->canGetCertificate($user, $course);

        return response()->json([
            'can_claim' => $eligibility['can_claim'],
            'progress' => [
                'total_lessons' => $eligibility['total_lessons'],
                'completed_lessons' => $eligibility['completed_lessons'],
                'percentage' => $eligibility['progress_percentage'],
            ],
            'quiz_score' => $eligibility['quiz_score'],
            'reason' => $eligibility['reason'],
        ]);
    }

    /**
     * Generate/claim certificate
     */
    public function store(Request $request, int $courseId): JsonResponse
    {
        $user = $request->user();
        $course = Course::findOrFail($courseId);

        try {
            $completion = $this->certificateService->generateCertificate($user, $course);
            $certificateData = $this->certificateService->getCertificateData($completion);

            return response()->json([
                'message' => 'Sertifikat berhasil dibuat!',
                'certificate' => $certificateData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get user's certificate for a course
     */
    public function show(Request $request, int $courseId): JsonResponse
    {
        $user = $request->user();
        $course = Course::findOrFail($courseId);

        $certificate = $user->getCertificate($courseId);

        if (!$certificate) {
            $eligibility = $this->certificateService->canGetCertificate($user, $course);
            
            return response()->json([
                'has_certificate' => false,
                'eligibility' => $eligibility,
            ]);
        }

        $certificateData = $this->certificateService->getCertificateData($certificate);

        return response()->json([
            'has_certificate' => true,
            'certificate' => $certificateData,
        ]);
    }

    /**
     * Download certificate as PDF
     */
    public function download(Request $request, int $courseId): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $user = $request->user();
        $course = Course::findOrFail($courseId);

        $certificate = $user->getCertificate($courseId);
        if (!$certificate) {
            abort(404, 'Sertifikat tidak ditemukan');
        }

        $certificateData = $this->certificateService->getCertificateData($certificate);

        // Generate HTML certificate
        $html = $this->generateCertificateHTML($certificateData);
        
        // For now, return as HTML download (can be converted to PDF with dompdf)
        $filename = 'certificate-' . $certificate->certificate_uuid . '.html';
        
        return Response::streamDownload(function () use ($html) {
            echo $html;
        }, $filename, [
            'Content-Type' => 'text/html; charset=utf-8',
        ]);
    }

    /**
     * Public certificate verification
     */
    public function verify(string $uuid): JsonResponse
    {
        $certificate = CourseCompletion::where('certificate_uuid', $uuid)->first();

        if (!$certificate) {
            return response()->json([
                'valid' => false,
                'message' => 'Sertifikat tidak ditemukan',
            ], 404);
        }

        $certificateData = $this->certificateService->getCertificateData($certificate);

        return response()->json([
            'valid' => true,
            'certificate' => $certificateData,
        ]);
    }

    /**
     * Generate certificate HTML
     */
    private function generateCertificateHTML(array $data): string
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - {$data['recipient_name']}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Georgia', serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .certificate {
            background: white;
            width: 100%;
            max-width: 800px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            position: relative;
            border: 20px solid;
            border-image: linear-gradient(45deg, #667eea, #764ba2) 1;
        }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { font-size: 48px; color: #667eea; margin-bottom: 10px; }
        .title {
            font-size: 36px;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 20px 0;
        }
        .subtitle {
            font-size: 18px;
            color: #666;
            font-style: italic;
        }
        .content { text-align: center; margin: 30px 0; }
        .recipient {
            font-size: 32px;
            color: #667eea;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            border-bottom: 3px solid #667eea;
            display: inline-block;
        }
        .course-title {
            font-size: 28px;
            color: #333;
            font-weight: bold;
            margin: 20px 0;
        }
        .description {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin: 20px 0;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .stat-item { text-align: center; }
        .stat-value { font-size: 24px; font-weight: bold; color: #667eea; }
        .stat-label { font-size: 14px; color: #666; margin-top: 5px; }
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e0e0e0;
        }
        .signature { text-align: center; }
        .signature-line {
            border-top: 2px solid #333;
            width: 200px;
            margin: 10px auto;
        }
        .signature-name { font-weight: bold; margin-top: 10px; }
        .signature-title { font-size: 14px; color: #666; }
        .date { text-align: center; }
        .date-value { font-size: 18px; font-weight: bold; }
        .verification {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
        .seal {
            position: absolute;
            bottom: 80px;
            right: 40px;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        @media print {
            body { background: white; }
            .certificate { box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="header">
            <div class="logo">🎓</div>
            <div class="title">Sertifikat Penyelesaian</div>
            <div class="subtitle">Certificate of Completion</div>
        </div>

        <div class="content">
            <p style="font-size: 18px; color: #666;">Diberikan kepada:</p>
            <div class="recipient">{$data['recipient_name']}</div>
            <p style="font-size: 16px; color: #666; margin-top: 20px;">
                Telah berhasil menyelesaikan kursus
            </p>
            <div class="course-title">{$data['course_title']}</div>
            <p class="description">{$data['course_description']}</p>

            <div class="stats">
                <div class="stat-item">
                    <div class="stat-value">{$data['total_lessons']}</div>
                    <div class="stat-label">Total Lessons</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{$data['quiz_score']}%</div>
                    <div class="stat-label">Quiz Score</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{$data['completion_date_full']}</div>
                    <div class="stat-label">Completion Date</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-name">{$data['instructor_name']}</div>
                <div class="signature-title">Instructor</div>
            </div>
            <div class="date">
                <div class="date-value">{$data['completion_date']}</div>
                <div style="font-size: 14px; color: #666;">Date of Completion</div>
            </div>
        </div>

        <div class="seal">
            OFFICIAL<br>CERTIFICATE
        </div>

        <div class="verification">
            <p>Certificate ID: {$data['certificate_uuid']}</p>
            <p>Verify at: {$data['verification_url']}</p>
            <p>Hash: {$data['certificate_hash']}</p>
        </div>
    </div>

    <script>
        // Auto-print on load (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
HTML;
    }
}
