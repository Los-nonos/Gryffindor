<?php


namespace Presentation\Http\Presenters\Customers;


use Application\Queries\Results\Customers\IndexCustomerResult;

class IndexCustomerPresenter
{
    private IndexCustomerResult $result;

    public function fromResult($result): IndexCustomerPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $customerList = [];
        $customers = $this->result->getCustomers();

        foreach ($customers as $user) {
            $customer = $user->getCustomer();
            array_push($customerList, [
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
            ]);
        }

        return $customerList;
    }
}
