<?php


namespace Application\Queries\Query\Categories;


use Infrastructure\QueryBus\Query\QueryInterface;

class IndexCategoryQuery implements QueryInterface
{
    private $page;
    private $size;

    /**
     * IndexCategoryQuery constructor.
     * @param $page
     * @param $size
     */
    public function __construct($page, $size)
    {

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
