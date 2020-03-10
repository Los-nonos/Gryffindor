<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\Manager;
use Domain\Interfaces\ManagerRepositoryInterface;
use Exception;

class ManagerRepository extends EntityRepository implements ManagerRepositoryInterface
{
    /**
     * DoctrineUserRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Manager::class));
    }

    /**
     * @param Manager $manager
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Manager $manager): void
    {
        $this->getEntityManager()->persist($manager);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $managerId
     * @return Manager|null
     * @throws Exception
     */
    public function getById(int $managerId): ?Manager
    {
        $manager = $this->find($managerId);

        if (!$manager) {
            throw new Exception('Teacher not found');
        }

        return $manager;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function all(): array
    {
        return $this->findAll();
    }
}
