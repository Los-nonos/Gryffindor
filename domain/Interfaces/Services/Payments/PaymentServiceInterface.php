<?php


namespace Domain\Interfaces\Services\Payments;


interface PaymentServiceInterface
{
    public function createClient(): void;

    public function login(string $username, string $password): void;

    public function mercadoPagoPaymentExecute($data);
}
