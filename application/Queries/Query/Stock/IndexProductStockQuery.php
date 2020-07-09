<?php


namespace Application\Queries\Query\Stock;


use Infrastructure\QueryBus\Query\QueryInterface;

class IndexProductStockQuery implements QueryInterface
{
    private ?int $page;

    private ?int $size;

    private ?int $minValue;

    public function __construct($page, $size, $minValue)
    {
        $this->page = $page;
        $this->size = $size;
        $this->minValue = $minValue;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @return int|null
     */
    public function getMinValue(): ?int
    {
        return $this->minValue;
    }
}
