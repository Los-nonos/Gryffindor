<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Domain\Entities\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function update(): void;
    public function getById(int $userId): ?User;
    public function getByTheEmail(string $email): ?User;
    public function getByUsername(string $username): ?User;
    public function existWithTheEmail(string $email): bool;
    public function all(): array;
    public function delete(User $user): void;
}
