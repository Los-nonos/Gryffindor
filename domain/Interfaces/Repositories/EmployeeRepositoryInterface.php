<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Employee;

interface EmployeeRepositoryInterface
{
    public function persist(Employee $employee): void;
    public function flush(): void;
    public function findOneById(int $id): ?Employee;
}
