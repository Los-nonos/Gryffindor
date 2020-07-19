<?php


namespace Application\Queries\Query\Providers;


use Infrastructure\QueryBus\Query\QueryInterface;

class IndexProvidersQuery implements QueryInterface
{
    private ?int $page;
    private ?int $size;

    public function __construct(?int $page, ?int $size)
    {
        $this->page = $page;
        $this->size = $size;
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function getSize()
    {
        return $this->size;
    }
}
