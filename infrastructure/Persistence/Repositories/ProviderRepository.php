<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Entities\Provider;
use Domain\Interfaces\Repositories\ProviderRepositoryInterface;

class ProviderRepository extends EntityRepository implements ProviderRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Provider::class));
    }

    /**
     * @param Provider $provider
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function persist(Provider $provider): void
    {
        $this->getEntityManager()->persist($provider);
        $this->getEntityManager()->flush();
    }

    //TODO Terminar ProviderRepository Update, FindById, FindByName, Delete
}
