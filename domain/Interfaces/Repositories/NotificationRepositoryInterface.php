<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Notification;

interface NotificationRepositoryInterface
{
    public function findByRole(string $role): array;

    public function findById(int $id): ?Notification;

    public function findByEmail(string $email): array;
}
