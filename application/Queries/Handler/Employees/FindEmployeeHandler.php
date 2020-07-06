<?php


namespace Application\Queries\Handler\Employees;


use Application\Queries\Query\Employees\FindEmployeeQuery;
use Application\Queries\Results\Employees\FindEmployeeResult;
use Application\Services\Users\UserServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindEmployeeHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param FindEmployeeQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $employees = $this->userService->findEmployees($query->getPage(), $query->getSize());

        $result = new FindEmployeeResult();
        $result->setEmployees($employees);
        return $result;
    }
}
