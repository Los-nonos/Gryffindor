<?php


namespace Domain\Interfaces\Services\Notifications;


use Domain\Entities\Notification;

interface NotificationServiceInterface
{
    public function findByRole(string $role): array;

    public function findByIdOrFail(int $id): ?Notification;

    public function findByEmail(string $email): array;

    public function persist(Notification $notification): void;
}
