<?php


namespace Presentation\Http\Presenters\Employees;


use Application\Queries\Results\Employees\FindOneEmployeeResult;

class FindOneEmployeePresenter
{
    private FindOneEmployeeResult $result;

    public function fromResult($result): FindOneEmployeePresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $employee = $this->result->getEmployee();
        return [
            'id' => $employee->getId(),
            'name' => $employee->getName(),
            'surname' => $employee->getSurname(),
            'email' => $employee->getEmail(),
            'roles' => $employee->getEmployee()->getRole(),
        ];
    }
}
