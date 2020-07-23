<?php


namespace Domain\Entities;

use Money\Money;

class Order
{
    private $id;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var string
     */
    private $amount;

    private $numberSell;

    /**
     * @var Employee
     */
    private $employee;

    /**
     * @var Product[]
     */
    private $products;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Money
     */
    public function getAmount()
    {
        return Money::ARS($this->amount);
    }

    /**
     * @param Money $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount->getAmount();
    }

    /**
     * @return mixed
     */
    public function getNumberSell()
    {
        return $this->numberSell;
    }

    /**
     * @param mixed $numberSell
     */
    public function setNumberSell($numberSell): void
    {
        $this->numberSell = $numberSell;
    }

    /**
     * @return Employee
     */
    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     */
    public function setEmployee(Employee $employee): void
    {
        $this->employee = $employee;
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function getCustomer() {
        return $this->customer;
    }

    public function setCustomer($customer) {
        $this->customer = $customer;
    }
}
