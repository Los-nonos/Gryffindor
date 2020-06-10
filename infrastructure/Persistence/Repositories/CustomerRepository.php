<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\Customer;
use Domain\Interfaces\Repositories\CustomerRepositoryInterface;

class CustomerRepository extends EntityRepository implements CustomerRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Customer::class));
    }

    /**
     * @param Customer $customer
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function persist(Customer $customer): void
    {
        $this->getEntityManager()->persist($customer);
        $this->update();
    }

    /**
     * @param int $id
     * @return Customer|null|object
     */
    public function findOneById(int $id): ?Customer
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * @param string $uuid
     * @return Customer|null|object
     */
    public function findOneByUuid(string $uuid): ?Customer
    {
        return $this->findOneBy(['uuid' => $uuid]);
    }

    /**
     * @param int $page
     * @param int $size
     * @return array
     */
    public function findAllPaginated(int $page, int $size): array
    {
        return $this->findBy([], null, $size, $page);
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
