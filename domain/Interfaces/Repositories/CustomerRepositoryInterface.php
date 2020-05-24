<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Customer;

interface CustomerRepositoryInterface
{
    public function persist(Customer $customer): void;
    public function findOneById(int $id): ?Customer;
    public function findOneByUuid(string $uuid): ?Customer;
    public function findAllPaginated(int $page, int $size): array;
    public function update(): void;
}
