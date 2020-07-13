<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Domain\Entities\Provider;
use Domain\Interfaces\Repositories\ProviderRepositoryInterface;

class ProviderRepository extends EntityRepository implements ProviderRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Provider::class));
    }

    //TODO Terminar ProviderRepository
}
