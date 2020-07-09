<?php


namespace Application\Queries\Handler\Customers;


use Application\Exceptions\EntityNotFoundException;
use Application\Queries\Query\Customers\FindCustomerQuery;
use Application\Queries\Results\Customers\FindCustomerResult;
use Application\Services\Users\UserServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindCustomerHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param FindCustomerQuery $query
     * @return ResultInterface
     * @throws EntityNotFoundException
     */
    public function handle($query): ResultInterface
    {
        $customer = $this->userService->findOneByIdOrFail($query->getId());

        if(!$customer->isCustomer())
        {
            $id = $query->getId();
            throw new EntityNotFoundException("Customer with id: $id not found");
        }

        $result = new FindCustomerResult();
        $result->setCustomer($customer);
        return $result;
    }
}
