<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Domain\Entities\Notification;
use Domain\Interfaces\Repositories\NotificationRepositoryInterface;

class NotificationRepository extends EntityRepository implements NotificationRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Notification::class));
    }


    public function findByRole(string $role): array
    {
        return $this->findBy(['role' => $role]);
    }

    public function findById(int $id): ?Notification
    {
        return $this->findBy(['id' => $id]);
    }

    public function findByEmail(string $email): array
    {
        return $this->findBy(['email' => $email]);
    }

    public function persist(Notification $notification): void
    {
        $this->getEntityManager()->persist($notification);
        $this->getEntityManager()->flush();
    }
}
