<?php


namespace Application\Queries\Results\Products;


use Infrastructure\QueryBus\Result\ResultInterface;

class ProductListResult implements ResultInterface
{
    private array $products;

    private int $totalQuantity;

    public function __construct(array $products, int $totalQuantity)
    {
        $this->products = $products;
        $this->totalQuantity = $totalQuantity;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getTotalQuantity(): int
    {
        return $this->totalQuantity;
    }
}
