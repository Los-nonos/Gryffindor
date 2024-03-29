<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domain\Entities\Category;
use Domain\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryRepository extends EntityRepository implements CategoryRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Category::class));
    }

    /**
     * @param Category $category
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function persist(Category $category): void
    {
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();
    }

    public function findOneById($id): ?Category
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function indexAndPaginated($page, $size): array
    {
        //return $this->findAll();

        // get entity manager
        //$em = $this->getEntityManager();
        // get the user repository

        // build the query for the doctrine paginator
        $query = $this->_em->createQueryBuilder()
            //->orderBy('c.id', 'ASC')
            ->select('category', 'f', 'o')
            ->from(Category::class, 'category')
            ->leftJoin('category.filters', 'f', Expr\Join::WITH, 'f.category = category.id')
            ->leftJoin('f.options', 'o', Expr\Join::WITH, 'o.filter = f.id')
            ->getQuery();

        // load doctrine Paginator
        $paginator = new Paginator($query);

        // you can get total items
        $totalItems = count($paginator);

        // get total pages
        $pagesCount = ceil($totalItems / $size);

        // now get one page's items:
        $paginator
            ->getQuery()
            ->setFirstResult($size * ($page-1)) // set the offset
            ->setMaxResults($size); // set the limit

        $categoryList = [];

        foreach ($paginator as $item) {
            array_push($categoryList, $item);
        }

        return $categoryList;
    }

    /**
     * @param Category $category
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function destroy(Category $category)
    {
        $this->getEntityManager()->remove($category);
        $this->getEntityManager()->flush();
    }
}
