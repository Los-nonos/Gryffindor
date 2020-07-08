<?php


namespace Application\Queries\Query\Employees;


use Infrastructure\QueryBus\Query\QueryInterface;

class FindOneEmployeeQuery implements QueryInterface
{
    private int $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}
