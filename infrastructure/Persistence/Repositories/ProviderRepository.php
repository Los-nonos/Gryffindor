<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domain\Entities\Provider;
use Domain\Entities\User;
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

    public function findOneById(int $id): ?Provider
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findAllPaginated($page, $size): array
    {
        // get entity manager
        $em = $this->getEntityManager();

        // get the user repository
        $providers = $em->getRepository(Provider::class);

        // build the query for the doctrine paginator
        $query = $providers->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->getQuery();

        // load doctrine Paginator
        $paginator = new Paginator($query);

        // now get one page's items:
        $paginator
            ->getQuery()
            ->setFirstResult($size * ($page-1)) // set the offset
            ->setMaxResults($size); // set the limit

        $providersList = [];

        foreach ($paginator as $item) {
            array_push($providersList, $item);
        }

        return $providersList;
    }
}
