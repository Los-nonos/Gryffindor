<?php


namespace Application\Queries\Handler\Orders;


use Application\Queries\Query\Orders\FindOrderByUuidQuery;
use Application\Queries\Results\Orders\FindOrderByUuidResult;
use Domain\Interfaces\Services\Orders\OrderServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindOrderByUuidHandler implements HandlerInterface
{
    private OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param FindOrderByUuidQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $order = $this->orderService->findByUuidOrFail($query->getUuid());

        $result = new FindOrderByUuidResult();
        $result->setOrder($order);
        return $result;
    }
}
