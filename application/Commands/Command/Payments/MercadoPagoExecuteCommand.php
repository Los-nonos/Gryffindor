<?php


namespace Application\Commands\Command\Payments;


use Infrastructure\CommandBus\Command\CommandInterface;
use Money\Money;

class MercadoPagoExecuteCommand implements CommandInterface
{
    private string $cartToken;
    private Money $amount;
    private int $customerId;
    private string $paymentMethod;
    private array $products;

    public function __construct(
        string $cartToken,
        string $amount,
        int $customerId,
        array $products,
        string $paymentMethod
    )
    {
        $this->cartToken = $cartToken;
        $this->amount = Money::ARS(intval($amount) * 100);
        $this->products = $products;
        $this->customerId = $customerId;
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return string
     */
    public function getCartToken(): string
    {
        return $this->cartToken;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}
