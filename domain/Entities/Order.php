<?php


namespace Domain\Entities;

use Money\Money;

class Order
{
    private $id;

    /**
     * @var User
     */
    private $customer;

    /**
     * @var Money
     */
    private $amount;

    private $numberSell;

    /**
     * @var User
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->customer;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->customer = $user;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
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
     * @return User
     */
    public function getEmployee(): User
    {
        return $this->employee;
    }

    /**
     * @param User $employee
     */
    public function setEmployee(User $employee): void
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
}
