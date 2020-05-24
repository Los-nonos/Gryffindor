<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\Admin;
use Domain\Interfaces\Repositories\AdminRepositoryInterface;

class AdminRepository extends EntityRepository implements AdminRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Admin::class));
    }

    /**
     * @param Admin $admin
     * @throws ORMException
     */
    public function persist(Admin $admin): void
    {
        $this->getEntityManager()->persist($admin);
        $this->update();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(): void
    {
        $this->getEntityManager()->flush();
    }
}
