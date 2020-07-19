<?php


namespace Application\Queries\Query\Brands;


use Infrastructure\QueryBus\Query\QueryInterface;

class FindBrandQuery implements QueryInterface
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
