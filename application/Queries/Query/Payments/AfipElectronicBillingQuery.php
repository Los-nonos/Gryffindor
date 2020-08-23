<?php


namespace Application\Queries\Query\Payments;


use Infrastructure\QueryBus\Query\QueryInterface;

class AfipElectronicBillingQuery implements QueryInterface
{
    /**
     * @var array
     */
    private array $products;
    private int $customerId;
    private string $typeVoucher;

    public function __construct(
        array $products,
        int $customerId,
        string $typeVoucher
    )
    {
        $this->typeVoucher = $typeVoucher;
        $this->products = $products;
        $this->customerId = $customerId;
    }

    /**
     * @return array productIds
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getTypeVoucher()
    {
        return $this->typeVoucher;
    }
}
