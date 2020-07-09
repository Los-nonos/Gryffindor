<?php


namespace Application\Services\Notification;


use Domain\Entities\Notification;
use Domain\Interfaces\Services\Notifications\NotificationServiceInterface;

class NotificationService implements NotificationServiceInterface
{

    public function findByRole(string $role): array
    {
        return $this->repository->findByRole($role);
    }

    public function findByIdOrFail(int $id): ?Notification
    {
        return $this->repository->findByIdOrFail($id);
    }

    public function findByEmail(string $email): array
    {
        return $this->repository->findByEmail($email);
    }
}
