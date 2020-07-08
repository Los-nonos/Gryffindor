<?php


namespace Application\Queries\Results\Products;


use Infrastructure\QueryBus\Result\ResultInterface;

class ProductListResult implements ResultInterface
{
    private array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}
