<?php


namespace Presentation\Http\Presenters\Employee;


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
            array_push($result, $employee);
        }

        return $result;
    }
}
