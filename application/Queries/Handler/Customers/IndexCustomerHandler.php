<?php


namespace Application\Queries\Handler\Customers;


use Application\Queries\Query\Customers\IndexCustomerQuery;
use Application\Queries\Results\Customers\IndexCustomerResult;
use Application\Services\Users\UserServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexCustomerHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param IndexCustomerQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $customers = $this->userService->findCustomers($query->getPage(), $query->getSize());

        $result = new IndexCustomerResult();
        $result->setCustomers($customers);
        return $result;
    }
}
