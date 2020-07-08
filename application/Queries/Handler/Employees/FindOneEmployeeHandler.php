<?php


namespace Application\Queries\Handler\Employees;


use Application\Exceptions\EntityNotFoundException;
use Application\Queries\Query\Employees\FindOneEmployeeQuery;
use Application\Queries\Results\Employees\FindOneEmployeeResult;
use Application\Services\Users\UserServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindOneEmployeeHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param FindOneEmployeeQuery $query
     * @return ResultInterface
     * @throws EntityNotFoundException
     */
    public function handle($query): ResultInterface
    {
        $employee = $this->userService->findOneByIdOrFail($query->getId());

        if(!$employee->isEmployee()) {
            $id = $query->getId();
            throw new EntityNotFoundException(`Employee with id: $id not found`);
        }

        $result = new FindOneEmployeeResult();
        $result->setEmployee($employee);
        return $result;
    }
}
