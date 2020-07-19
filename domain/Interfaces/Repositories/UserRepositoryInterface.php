<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\User;

interface UserRepositoryInterface
{
    public function persist(User $user): void;
    public function flush(): void;
    public function findOneById(int $userId): ?User;
    public function findOneByTheEmail(string $email): ?User;
    public function findOneByUsername(string $username): ?User;
    public function findOneByEmployeeId(int $employeeId): ?User;
    public function existWithTheEmail(string $email): bool;
    public function findAll(): array;
    public function destroy(User $user): void;
    public function findEmployees($page, $size);
    public function findCustomers(int $page, int $size, ?string $name, ?string $dni, ?string $cuil);
}
