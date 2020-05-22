<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\Employee;
use Domain\Entities\Token;
use Domain\Interfaces\Repositories\EmployeeRepositoryInterface;

class EmployeeRepository extends EntityRepository implements EmployeeRepositoryInterface
{
    /**
     * DoctrineUserRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Token::class));
    }

    /**
     * @param int $id
     * @return Employee|null|object
     */
    public function findOneById(int $id): ?Employee
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * @param Employee $employee
     * @throws ORMException
     */
    public function persist(Employee $employee): void
    {
        $this->getEntityManager()->persist($employee);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
