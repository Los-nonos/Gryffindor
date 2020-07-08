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

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'email' => $user->getEmail(),
            'isActive' => $user->isActive(),
            'uuid' => $customer->getUuid(),
            'age' => $customer->getAge(),
            'dni' => $customer->getDni(),
            'birthday' => $customer->getBirthday(),
            'postalCode' => $customer->getPostalCode(),
            'country' => $customer->getCountry(),
            'state' => $customer->getState(),
            'city' => $customer->getCity(),
            'vatCondition' => $customer->getVatCondition(),
            'taxationKey' => $customer->getTaxationKey(),
            'grossIncome' => $customer->getGrossIncome(),
            'phoneNumber' => $customer->getPhoneNumber(),
        ];
    }
}
