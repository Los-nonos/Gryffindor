<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\Organization;
use Domain\Interfaces\OrganizationRepositoryInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

class OrganizationRepository extends EntityRepository implements OrganizationRepositoryInterface
{
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Organization::class));
    }

    /**
     * @param Organization $organization
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Organization $organization): void
    {
        $this->getEntityManager()->persist($organization);
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
     * @param int $organizationId
     * @return Organization|null
     * @throws Exception
     */
    public function getById(int $organizationId): ?Organization
    {
        $organization = $this->find($organizationId);

        if(!$organization){
            throw new EntityNotFoundException('Organization not found');
        }

        return $organization;
    }

    /**
     * @param string $organizationName
     * @return bool
     */
    public function existWithTheName(string $organizationName): bool
    {
        $organization = $this->findOneBy(['organizationName' => $organizationName]);

        if(!$organization){
            return false;
        }
        return true;
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
     * @param Organization $organization
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Organization $organization): void
    {
        $this->getEntityManager()->remove($organization);
        $this->getEntityManager()->flush();
    }
}
