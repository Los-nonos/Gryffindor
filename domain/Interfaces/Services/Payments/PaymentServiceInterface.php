<?php


namespace Domain\Interfaces\Services\Payments;

use Domain\ValueObjects\Payment;

interface PaymentServiceInterface
{
    public function createClient(): void;

    public function login(string $username, string $password): void;

    public function mercadoPagoPaymentExecute(Payment $data);
}
