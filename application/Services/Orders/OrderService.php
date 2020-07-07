<?php


namespace Application\Services\Orders;


use App\Exceptions\InvalidBodyException;
use Application\Exceptions\EntityNotFoundException;
use Domain\Entities\Order;
use Domain\Interfaces\Repositories\OrderRepositoryInterface;
use Domain\Interfaces\Services\Orders\OrderServiceInterface;

class OrderService implements OrderServiceInterface
{
    private OrderRepositoryInterface $repository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->repository = $orderRepository;
    }

    public function indexAndFiltered($page, $size, $userId): array
    {
        $page = $page ? $page : 1;
        $size = $size ? $size : 10;

        return $this->repository->indexAndFiltered($page, $size, $userId);
    }

    public function indexAll($page, $size): array
    {
        $page = $page ? $page : 1;
        $size = $size ? $size : 10;

        return $this->repository->indexAll($page, $size);
    }

    /**
     * @param string $uuid
     * @return Order
     * @throws EntityNotFoundException
     */
    public function findByUuidOrFail(string $uuid): Order
    {
        $order = $this->repository->findByUuid($uuid);

        if(!$order) {
            throw new EntityNotFoundException("Order not exist!");
        }

        return $order;
    }
}
