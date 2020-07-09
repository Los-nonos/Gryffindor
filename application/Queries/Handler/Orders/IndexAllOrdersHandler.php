<?php


namespace Application\Queries\Handler\Orders;


use Application\Exceptions\EntityNotFoundException;
use Application\Queries\Query\Orders\IndexAllOrdersQuery;
use Application\Queries\Query\Orders\IndexOrdersQuery;
use Application\Queries\Results\Orders\IndexOrdersResult;
use Application\Services\Users\UserServiceInterface;
use Domain\Interfaces\Services\Orders\OrderServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexAllOrdersHandler implements HandlerInterface
{
    private OrderServiceInterface $orderService;

    public function __construct(
        OrderServiceInterface $orderService
    )
    {
        $this->orderService = $orderService;
    }

    /**
     * @param IndexAllOrdersQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $orders = $this->orderService->indexAll($query->getPage(), $query->getSize());

        $result = new IndexOrdersResult();
        $result->setOrders($orders);
        return $result;
    }
}
