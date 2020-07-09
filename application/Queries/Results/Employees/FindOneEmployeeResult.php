<?php


namespace Application\Queries\Results\Employees;


use Infrastructure\QueryBus\Result\ResultInterface;

class FindOneEmployeeResult implements ResultInterface
{
    private $employee;

    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }

    public function getEmployee() {
        return $this->employee;
    }
}
