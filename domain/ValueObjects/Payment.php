<?php


namespace Domain\ValueObjects;


class Payment
{
    private string $amount;
    private string $email;
    private string $cartToken;
    private string $paymentMethod;

    public function __construct(string $amount, string $emailPayer, string $cartToken, string $paymentMethod)
    {
        $this->amount = $amount;
        $this->email  = $emailPayer;
        $this->cartToken = $cartToken;
        $this->paymentMethod = $paymentMethod;
    }

    public function getAmount(): string {
        return $this->amount;
    }

    public function getEmailPayer(): string {
        return $this->email;
    }

    public function getCartToken(): string {
        return $this->cartToken;
    }

    public function getPaymentMethod(): string {
        return $this->paymentMethod;
    }
}
