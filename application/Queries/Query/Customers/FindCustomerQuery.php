<?php


namespace Application\Queries\Query\Customers;


use Infrastructure\QueryBus\Query\QueryInterface;

class FindCustomerQuery implements QueryInterface
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}
