<?php


namespace Application\Queries\Results\Customers;


use Infrastructure\QueryBus\Result\ResultInterface;

class FindCustomerResult implements ResultInterface
{
    private $customer;

    public function setCustomer($customer) {
        $this->customer = $customer;
    }

    public function getCustomer() {
        return $this->customer;
    }
}
