<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domain\Entities\Brand;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\BrandRepositoryInterface;

class BrandRepository extends EntityRepository implements BrandRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Brand::class));
    }

    public function persist(Brand $brand): void
    {
        $this->getEntityManager()->persist($brand);
        $this->getEntityManager()->flush();
    }

    public function findOneById(int $id): ?Brand
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findOneByName(string $name): ?Brand
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findAllPaginated(int $page, int $size): array
    {
        // get entity manager
        $em = $this->getEntityManager();

        // get the user repository
        $brands = $em->getRepository(Brand::class);

        // build the query for the doctrine paginator
        $query = $brands->createQueryBuilder('u')
            ->orderBy('u.name', 'ASC')
            ->getQuery();

        // load doctrine Paginator
        $paginator = new Paginator($query);

        // now get one page's items:
        $paginator
            ->getQuery()
            ->setFirstResult($size * ($page-1)) // set the offset
            ->setMaxResults($size); // set the limit

        $brandsList = [];

        foreach ($paginator as $item) {
            array_push($brandsList, $item);
        }

        return $brandsList;
    }
}
