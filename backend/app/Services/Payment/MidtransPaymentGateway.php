<?php

namespace App\Services\Payment;

use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction as MidtransTransaction;

class MidtransPaymentGateway implements PaymentGatewayInterface
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Transaction $transaction, array $customerDetails): string
    {
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->order_id,
                'gross_amount' => (int) $transaction->amount,
            ],
            'customer_details' => $customerDetails,
            'item_details' => [
                [
                    'id' => $transaction->course_id,
                    'price' => (int) $transaction->amount,
                    'quantity' => 1,
                    'name' => $transaction->course->title,
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }

    public function getStatus(string $orderId): array
    {
        return (array) MidtransTransaction::status($orderId);
    }

    public function handleNotification(array $payload): array
    {
        return [
            'order_id' => $payload['order_id'],
            'transaction_status' => $payload['transaction_status'],
            'payment_type' => $payload['payment_type'] ?? null,
            'fraud_status' => $payload['fraud_status'] ?? null,
            'signature_key' => $payload['signature_key'] ?? null,
            'status_code' => $payload['status_code'] ?? null,
            'gross_amount' => $payload['gross_amount'] ?? null,
        ];
    }

    public function verifySignature(array $payload): bool
    {
        $serverKey = config('services.midtrans.server_key');
        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];

        $signature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return $signature === ($payload['signature_key'] ?? '');
    }
}
