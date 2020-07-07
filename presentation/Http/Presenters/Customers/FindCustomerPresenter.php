<?php


namespace Presentation\Http\Presenters\Customers;


use Application\Queries\Results\Customers\FindCustomerResult;

class FindCustomerPresenter
{
    private FindCustomerResult $result;

    public function fromResult($result): FindCustomerPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $user = $this->result->getCustomer();
        $customer = $user->getCustomer();

        //TODO: agregar campos que faltan
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'email' => $user->getEmail(),
        ];
    }
}
