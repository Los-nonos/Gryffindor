<?php


namespace Application\Services\Customers;


use Domain\Entities\Customer;
use Domain\Entities\User;

interface CustomerServiceInterface
{
    public function persist(Customer $customer): void;
    public function findOneByIdOrFail(int $id): Customer;
    public function findOneByUserIdOrFail(int $id): User;
    public function update(): void;
    public function findOneByEmailOrFail(string $email): User;
}
