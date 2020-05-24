<?php


namespace Application\Services\Customers;


use Domain\Entities\Customer;

interface CustomerServiceInterface
{
    public function persist(Customer $customer): void;
}
