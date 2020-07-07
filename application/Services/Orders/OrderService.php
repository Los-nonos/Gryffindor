<?php


namespace Application\Services\Orders;


use App\Exceptions\InvalidBodyException;
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
}
