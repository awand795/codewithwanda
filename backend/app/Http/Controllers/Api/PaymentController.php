<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Course;
use App\Services\Payment\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentService $paymentService,
    ) {}

    public function create(CreatePaymentRequest $request): JsonResponse
    {
        $course = Course::findOrFail($request->course_id);

        if ($request->user()->hasPurchasedCourse($course->id)) {
            return response()->json(['message' => 'You have already purchased this course.'], 400);
        }

        $result = $this->paymentService->initiateCoursePurchase($request->user(), $course);

        return response()->json([
            'snap_token' => $result['snap_token'],
            'transaction' => new TransactionResource($result['transaction']),
        ]);
    }

    public function webhook(Request $request): JsonResponse
    {
        try {
            $transaction = $this->paymentService->handleWebhookNotification($request->all());

            return response()->json(['message' => 'OK']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function status(Request $request, string $orderId): JsonResponse
    {
        $transaction = $this->paymentService->checkTransactionStatus($orderId);

        return response()->json([
            'data' => new TransactionResource($transaction),
        ]);
    }

    public function history(Request $request): JsonResponse
    {
        $transactions = $request->user()
            ->transactions()
            ->with('course')
            ->latest()
            ->paginate(10);

        return response()->json([
            'data' => TransactionResource::collection($transactions->items()),
            'meta' => [
                'current_page' => $transactions->currentPage(),
                'last_page' => $transactions->lastPage(),
                'per_page' => $transactions->perPage(),
                'total' => $transactions->total(),
            ],
        ]);
    }
}
