<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domain\Entities\Product;
use Domain\Interfaces\Repositories\ProductRepositoryInterface;
use Infrastructure\Persistence\Queries\ProductQueryBuilder;

class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Product::class));
        //TODO WTF? REPOSITORY?? DOOOOCTRINE
    }

    public function findByQuery(
        string $query = null,
        array $categories = null,
        array $brands = null,
        array $providers = null,
        int $page = null,
        int $limit = null,
        string $order = null
    ): array {
        $productQueryBuilder = new ProductQueryBuilder($this->getEntityManager());
        if ($query) {
            $productQueryBuilder->byQuery($query);
        }
        if ($brands) {
            $productQueryBuilder->byBrand($brands);
        }
        if ($categories) {
            $productQueryBuilder->byCategories($categories);
        }
        if ($order) {
            $productQueryBuilder->addOrderBy($order);
        }
        if ($page && $limit) {
            $productQueryBuilder->addPageAndLimitBy($page, $limit);
        }

        $productIds = $productQueryBuilder->executeQueryBuilder();
        $products = [];
        foreach ($productIds as $productId) {
            $products[] = $this->findOneBy(['id' => (int)$productId['id']]);
        }

        return $products;
    }

    public function findAllPaginated($page, $size): array
    {
        // get entity manager
        $em = $this->getEntityManager();

        // get the user repository
        $products = $em->getRepository(Product::class);

        // build the query for the doctrine paginator
        $query = $products->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
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
}
