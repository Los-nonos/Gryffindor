<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\CompanyAdmin;
use Domain\Interfaces\CompanyAdminRepositoryInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class CompanyAdminRepository extends EntityRepository implements CompanyAdminRepositoryInterface
{
    /**
     * DoctrineUserRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(CompanyAdmin::class));
    }

    /**
     * @param CompanyAdmin $companyAdmin
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(CompanyAdmin $companyAdmin): void
    {
        $this->getEntityManager()->persist($companyAdmin);
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
     * @param int $companyAdminId
     * @return CompanyAdmin|null
     * @throws Exception
     */
    public function getById(int $companyAdminId): ?CompanyAdmin
    {
        $companyAdmin = $this->find($companyAdminId);

        if(!$companyAdmin){
            throw new EntityNotFoundException('Company Admin not found');
        }

        return $companyAdmin;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function all(): array
    {
        return $this->findAll();
    }

    /**
     * @param CompanyAdmin $companyAdmin
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(CompanyAdmin $companyAdmin): void
    {
        $this->getEntityManager()->remove($companyAdmin);
        $this->getEntityManager()->flush();
    }
}
