<?php


namespace Presentation\Http\Presenters\Employees;


use Application\Queries\Results\Employees\FindEmployeeResult;

class FindEmployeePresenter
{
    private FindEmployeeResult $result;

    public function fromResult($result): FindEmployeePresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $result = [];
        $employees = $this->result->getEmployees();

        foreach ($employees as $employee) {
            //dd($employee);
            array_push($result, [
                'id' => $employee->getId(),
                'name' => $employee->getName(),
                'surname' => $employee->getSurname(),
                'email' => $employee->getEmail(),
                'roles' => $employee->getEmployee()->getRole(),
            ]);
        }

        return $result;
    }
}
