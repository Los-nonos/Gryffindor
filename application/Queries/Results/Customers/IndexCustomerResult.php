<?php


namespace Application\Queries\Results\Customers;


use Infrastructure\QueryBus\Result\ResultInterface;

class IndexCustomerResult implements ResultInterface
{
    private $customers;

    public function setCustomers($customers): void {
        $this->customers = $customers;
    }

    public function getCustomers() {
        return $this->customers;
    }
}
