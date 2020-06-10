<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\Filter;
use Domain\Interfaces\Repositories\FilterRepositoryInterface;

class FilterRepository extends EntityRepository implements FilterRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Filter::class));
    }

    /**
     * @param Filter $filter
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function persist(Filter $filter)
    {
        $this->getEntityManager()->persist($filter);
        $this->getEntityManager()->flush();
    }
}
