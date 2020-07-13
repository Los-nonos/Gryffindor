<?php


namespace Application\Queries\Query\Payments;


use Infrastructure\QueryBus\Query\QueryInterface;

class GetProductsFromShoppingCartQuery implements QueryInterface
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
