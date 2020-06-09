<?php


namespace Domain\Entities;


class Order
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var Product[]
     */
    private $products;

    /**
     * @var User
     */
    private $customer;

    /**
     * @var User
     */
    private $seller;

    /**
     * @var float
     */
    private $amount;

    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
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

    /**
     * @return User
     */
    public function getCustomer(): User
    {
        return $this->customer;
    }

    /**
     * @param User $customer
     */
    public function setCustomer(User $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return User
     */
    public function getSeller(): User
    {
        return $this->seller;
    }

    /**
     * @param User $seller
     */
    public function setSeller(User $seller): void
    {
        $this->seller = $seller;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }
}
