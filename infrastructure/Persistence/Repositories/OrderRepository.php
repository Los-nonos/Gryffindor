<?php


namespace Infrastructure\Persistence\Repositories;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domain\Entities\Order;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\OrderRepositoryInterface;

class OrderRepository extends EntityRepository implements OrderRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Order::class));
    }

    public function indexAndFiltered(int $page, int $size, int $userId): array
    {
        // get entity manager
        $em = $this->getEntityManager();

        // get the user repository
        $orders = $em->getRepository(Order::class);

        // build the query for the doctrine paginator
        $query = $orders->createQueryBuilder('o')
            ->where('o.customer = :customer')
            ->setParameter('customer', $userId)
            //->orderBy('u.id', 'DESC')
            ->getQuery();

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

    public function indexAll(int $page, int $size)
    {
        // get entity manager
        $em = $this->getEntityManager();

        // get the user repository
        $orders = $em->getRepository(Order::class);

        // build the query for the doctrine paginator
        $query = $orders->createQueryBuilder('o')
            //->where('o.customer = :customer')
            ->orderBy('o.id', 'DESC')
            ->getQuery();

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

    /**
     * @param string $uuid
     * @return Order|null
     */
    public function findByUuid(string $uuid): ?Order
    {
        return $this->findOneBy(['numberSell' => $uuid]);
    }

    public function persist(Order $order)
    {
        $this->getEntityManager()->persist($order);
        $this->getEntityManager()->flush();
    }
}
