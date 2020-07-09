<?php


namespace Application\Queries\Query\Stock;


use Infrastructure\QueryBus\Query\QueryInterface;

class FindProductStockQuery implements QueryInterface
{

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
