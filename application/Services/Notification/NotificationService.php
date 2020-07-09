<?php


namespace Application\Services\Notification;


use Application\Exceptions\EntityNotFoundException;
use Domain\Entities\Notification;
use Domain\Interfaces\Repositories\NotificationRepositoryInterface;
use Domain\Interfaces\Services\Notifications\NotificationServiceInterface;

class NotificationService implements NotificationServiceInterface
{
    private NotificationRepositoryInterface $repository;

    public function __construct(NotificationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findByRole(string $role): array
    {
        return $this->repository->findByRole($role);
    }

    public function findByIdOrFail(int $id): ?Notification
    {
        $notification = $this->repository->findById($id);

        if (!$notification) {
            throw new EntityNotFoundException("Notification with id: $id not found");
        }

        return $notification;
    }

    public function findByEmail(string $email): array
    {
        return $this->repository->findByEmail($email);
    }

    public function persist(Notification $notification): void
    {
        $this->repository->persist($notification);
    }
}
