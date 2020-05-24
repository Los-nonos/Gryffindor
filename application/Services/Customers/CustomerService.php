<?php


namespace Application\Services\Customers;


use Domain\Entities\Customer;
use Domain\Interfaces\Repositories\CustomerRepositoryInterface;

class CustomerService implements CustomerServiceInterface
{
    private CustomerRepositoryInterface $repository;

    public function __construct(
        CustomerRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function persist(Customer $customer): void
    {
        $this->repository->persist($customer);
    }
}
