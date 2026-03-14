<?php

namespace App\Services\Payment;

use App\Models\Course;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;

class PaymentService
{
    public function __construct(
        private PaymentGatewayInterface $gateway,
    ) {}

    public function initiateCoursePurchase(User $user, Course $course): array
    {
        $existingTransaction = Transaction::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('payment_status', 'pending')
            ->first();

        if ($existingTransaction && $existingTransaction->snap_token) {
            return [
                'transaction' => $existingTransaction,
                'snap_token' => $existingTransaction->snap_token,
            ];
        }

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'order_id' => 'WLS-' . Str::upper(Str::random(8)) . '-' . time(),
            'amount' => $course->price,
            'payment_status' => 'pending',
        ]);

        $customerDetails = [
            'first_name' => $user->name,
            'email' => $user->email,
        ];

        $snapToken = $this->gateway->createTransaction($transaction, $customerDetails);

        $transaction->update(['snap_token' => $snapToken]);

        return [
            'transaction' => $transaction,
            'snap_token' => $snapToken,
        ];
    }

    public function handleWebhookNotification(array $payload): Transaction
    {
        if ($this->gateway instanceof MidtransPaymentGateway) {
            if (! $this->gateway->verifySignature($payload)) {
                throw new \Exception('Invalid signature');
            }
        }

        $notification = $this->gateway->handleNotification($payload);

        $transaction = Transaction::where('order_id', $notification['order_id'])->firstOrFail();

        $status = $notification['transaction_status'];

        if ($status === 'capture' || $status === 'settlement') {
            $transaction->update([
                'payment_status' => 'settlement',
                'payment_type' => $notification['payment_type'],
                'midtrans_response' => $payload,
                'paid_at' => now(),
            ]);

            $transaction->user->update(['role' => 'premium']);
        } elseif (in_array($status, ['deny', 'cancel', 'expire'])) {
            $transaction->update([
                'payment_status' => $status,
                'midtrans_response' => $payload,
            ]);
        }

        return $transaction->fresh();
    }

    public function checkTransactionStatus(string $orderId): Transaction
    {
        $transaction = Transaction::where('order_id', $orderId)->firstOrFail();
        $status = $this->gateway->getStatus($orderId);

        $transactionStatus = $status['transaction_status'] ?? $transaction->payment_status;

        if ($transactionStatus === 'settlement' && $transaction->payment_status !== 'settlement') {
            $transaction->update([
                'payment_status' => 'settlement',
                'payment_type' => $status['payment_type'] ?? null,
                'midtrans_response' => $status,
                'paid_at' => now(),
            ]);
            $transaction->user->update(['role' => 'premium']);
        }

        return $transaction->fresh();
    }
}
