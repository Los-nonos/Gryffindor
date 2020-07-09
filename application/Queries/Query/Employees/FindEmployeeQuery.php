<?php


namespace Application\Queries\Query\Employees;


use Infrastructure\QueryBus\Query\QueryInterface;

class FindEmployeeQuery implements QueryInterface
{
    private $page;
    private $size;

    public function __construct($page, $size)
    {
        $this->page = $page;
        $this->size = $size;
    }

    public function getPage() {
        return $this->page;
    }

    public function getSize() {
        return $this->size;
    }
}
