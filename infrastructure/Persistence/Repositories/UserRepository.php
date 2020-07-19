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
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domain\Entities\User;
use Doctrine\ORM\Query\Expr;
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
     * @return User|null
     */
    public function findOneById(int $userId): ?User
    {
        return $this->find($userId);
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
     * @return User|null|object
     */
    public function findOneByUsername(string $username): ?User
    {
        return $this->findOneBy(['username'=> $username]);
    }

    /**
     * @param int $employeeId
     * @return User|null
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findOneByEmployeeId(int $employeeId): ?User
    {
        $dqlQuery = $this->createQueryBuilder('u');
        $dqlQuery->where('u.employee = :employeeId')
            ->setParameter('employeeId', $employeeId);

        return $dqlQuery->getQuery()->getSingleResult();
    }

    public function findEmployees($page, $size)
    {
        // get entity manager
        $em = $this->getEntityManager();

        // get the user repository
        $employees = $em->getRepository(User::class);

        // build the query for the doctrine paginator
        $query = $employees->createQueryBuilder('u')
            ->where('NOT u.employee IS null')
            //->orderBy('u.id', 'DESC')
            ->getQuery();

        // load doctrine Paginator
        $paginator = new Paginator($query);

        // now get one page's items:
        $paginator
            ->getQuery()
            ->setFirstResult($size * ($page-1)) // set the offset
            ->setMaxResults($size); // set the limit

        $employeesList = [];

        foreach ($paginator as $item) {
            array_push($employeesList, $item);
        }

        return $employeesList;
    }

    public function findCustomers(int $page, int $size, ?string $name, ?string $dni, ?string $cuil)
    {
        // get entity manager
        $em = $this->getEntityManager();

        // get the user repository
        $customers = $em->getRepository(User::class);

        // build the query for the doctrine paginator
        if(isset($name) || isset($dni) || isset($cuil)) {
            $query = $customers->createQueryBuilder('u')
                ->select('u', 'c')
                ->leftJoin('u.customer', 'c', Expr\Join::WITH, 'u.customer = c.id')
                ->where('NOT u.customer IS null')
                ->andWhere('u.name LIKE :name')
                ->orWhere('c.dni LIKE :dni')
                ->orWhere('c.cuil LIKE :cuil')
                ->setParameter('name',"%$name%")
                ->setParameter('dni',"%$dni%")
                ->setParameter('cuil',"%$cuil%")
                //->orderBy('u.id', 'DESC')
                ->getQuery();
        }else {
            $query = $customers->createQueryBuilder('u')
                ->where('NOT u.customer IS null')
                //->orderBy('u.id', 'DESC')
                ->getQuery();
        }


        // load doctrine Paginator
        $paginator = new Paginator($query);

        // now get one page's items:
        $paginator
            ->getQuery()
            ->setFirstResult($size * ($page-1)) // set the offset
            ->setMaxResults($size); // set the limit

        $customersList = [];

        foreach ($paginator as $item) {
            array_push($customersList, $item);
        }

        return $customersList;
    }
}
