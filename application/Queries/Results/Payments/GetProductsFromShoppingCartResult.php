<?php


namespace Application\Queries\Results\Payments;


use Infrastructure\QueryBus\Result\ResultInterface;

class GetProductsFromShoppingCartResult implements ResultInterface
{
    private array $products;

    public function __construct($products)
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
