<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domain\Entities\Stock;
use Domain\Interfaces\Repositories\StockRepositoryInterface;

class StockRepository extends EntityRepository implements StockRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Stock::class));
    }

    public function persist(Stock $stock): void
    {
        $this->getEntityManager()->persist($stock);
        $this->getEntityManager()->flush();
    }

    public function findOneById(int $id): ?Stock {
        return $this->findOneBy(['id' => $id]);
    }

    public function findWithLowerStock(int $value): array
    {
        // get entity manager
        $em = $this->getEntityManager();

        // get the user repository
        $stocks = $em->getRepository(Stock::class);

        // build the query for the doctrine paginator
        $query = $stocks->createQueryBuilder('u')
            ->where('u.quantity = :quantity')
            ->setParameter('quantity', $value)
            ->orderBy('u.id', 'ASC')
            ->getQuery();

        // load doctrine Paginator
        $paginator = new Paginator($query);

        // now get one page's items:
        $paginator->getQuery();

        $stocksList = [];

        foreach ($paginator as $item) {
            array_push($brandsList, $item);
        }

        return $stocksList;
    }
}
