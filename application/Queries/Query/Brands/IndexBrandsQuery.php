<?php


namespace Application\Queries\Query\Brands;


use Infrastructure\QueryBus\Query\QueryInterface;

class IndexBrandsQuery implements QueryInterface
{
    private $page;
    private $size;

    public function __construct($page, $size)
    {
        $this->page = $page;
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }
}
