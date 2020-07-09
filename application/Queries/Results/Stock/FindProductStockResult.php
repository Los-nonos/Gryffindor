<?php


namespace Application\Queries\Results\Stock;


use Domain\Entities\Stock;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindProductStockResult implements ResultInterface
{
    private Stock $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return Stock
     */
    public function getStock(): Stock
    {
        return $this->stock;
    }
}
