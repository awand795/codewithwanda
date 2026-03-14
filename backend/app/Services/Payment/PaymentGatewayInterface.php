<?php

namespace App\Services\Payment;

use App\Models\Transaction;

interface PaymentGatewayInterface
{
    public function createTransaction(Transaction $transaction, array $customerDetails): string;

    public function getStatus(string $orderId): array;

    public function handleNotification(array $payload): array;
}
