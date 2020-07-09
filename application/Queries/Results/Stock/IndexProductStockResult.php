<?php


namespace Application\Queries\Results\Stock;


use Infrastructure\QueryBus\Result\ResultInterface;

class IndexProductStockResult implements ResultInterface
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
