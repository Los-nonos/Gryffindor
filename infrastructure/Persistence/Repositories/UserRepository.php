<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * DoctrineUserRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(User::class));
    }

    /**
     * @param User $user
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function persist(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $userId
     * @return object
     * @throws Exception
     */
    public function findOneById(int $userId): ?User
    {
        $user = $this->find($userId);

        if(!$user){
            throw new EntityNotFoundException('User not found');
        }

        return $user;
    }

    /**
     * @param string $email
     * @return User|null|object
     * @throws EntityNotFoundException
     */
    public function findOneByTheEmail(string $email): ?User
    {
        $user = $this->findOneBy(['email' => $email]);

        if(!$user){
            throw new EntityNotFoundException('User not found');
        }

        return $user;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function existWithTheEmail(string $email): bool
    {
        $user = $this->findOneBy(['email' => $email]);

        if(!$user){
            return false;
        }
        return true;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function findAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param User $user
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function destroy(User $user): void
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $username
     * @return User|null|object //TODO: verificate if don't have user throw exception
     * @throws ORMException
     */
    public function findOneByUsername(string $username): ?User
    {
        $user = $this->findOneBy(['username'=> $username]);

        if(!$user)
        {
            throw new EntityNotFoundException("User with username $username not found");
        }
        return $user;
    }

    /**
     * @param int $employeeId
     * @return User|null
     * @throws EntityNotFoundException
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findOneByEmployeeId(int $employeeId): ?User
    {
        $dqlQuery = $this->createQueryBuilder('u');
        $dqlQuery->where('u.employee = :employeeId')
            ->setParameter('employeeId', $employeeId);

        $user = $dqlQuery->getQuery()->getSingleResult();

        if(!$user){
            throw new EntityNotFoundException('User not found');
        }

        return $user;
    }
}
