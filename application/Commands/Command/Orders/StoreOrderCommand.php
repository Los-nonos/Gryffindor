<?php


namespace Application\Commands\Command\Orders;


use Infrastructure\CommandBus\Command\CommandInterface;
use Money\Money;

class StoreOrderCommand implements CommandInterface
{
    private Money $amount;
    private int $customerId;
    private int $employeeId;
    private array $products;

    /**
     * StoreOrderCommand constructor.
     * @param string $amount
     * @param int $customerId
     * @param int $employeeId
     * @param array $products
     */
    public function __construct(string $amount, int $customerId, int $employeeId, array $products)
    {
        $this->amount = Money::ARS(intval($amount) * 100);
        $this->customerId = $customerId;
        $this->employeeId = $employeeId;
        $this->products = $products;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}
