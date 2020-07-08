<?php


namespace Application\Queries\Results\Employees;


use Infrastructure\QueryBus\Result\ResultInterface;

class FindEmployeeResult implements ResultInterface
{
    private $employees;

    public function setEmployees($employees) {
        $this->employees = $employees;
    }

    public function getEmployees(): array {
        return $this->employees;
    }
}
