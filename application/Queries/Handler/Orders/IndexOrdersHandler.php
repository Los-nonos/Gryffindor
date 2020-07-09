<?php


namespace Application\Queries\Handler\Orders;


use Application\Exceptions\EntityNotFoundException;
use Application\Queries\Query\Orders\IndexOrdersQuery;
use Application\Queries\Results\Orders\IndexOrdersResult;
use Application\Services\Users\UserServiceInterface;
use Domain\Interfaces\Services\Orders\OrderServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexOrdersHandler implements HandlerInterface
{
    private OrderServiceInterface $orderService;

    private UserServiceInterface $userService;

    public function __construct(
        OrderServiceInterface $orderService,
        UserServiceInterface $userService
    )
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    /**
     * @param IndexOrdersQuery $query
     * @return ResultInterface
     * @throws EntityNotFoundException
     */
    public function handle($query): ResultInterface
    {
        $user = $this->userService->findOneByIdOrFail($query->getUserId());

        if(!$user->isCustomer()) {
            throw new EntityNotFoundException("User is not customer");
        }

        $orders = $this->orderService->indexAndFiltered($query->getPage(), $query->getSize(), $user->getCustomer()->getId());

        $result = new IndexOrdersResult();
        $result->setOrders($orders);
        return $result;
    }
}
