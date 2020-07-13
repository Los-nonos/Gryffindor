<?php


namespace Domain\Entities;


use Money\Money;

class PurchaseOrder
{
    private $id;

    /**
     * @var
     */
    private $provider;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var string
     */
    private string $purchaseNumber;

    /**
     * @var User
     */
    private $buyerUser;

    /**
     * @var Product[]
     */
    private $products;

    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param Provider $provider
     */
    public function setProvider($provider): void
    {
        $this->provider = $provider;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @param Money $amount
     */
    public function setAmount(Money $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getPurchaseNumber(): string
    {
        return $this->purchaseNumber;
    }

    /**
     * @param string $purchaseNumber
     */
    public function setPurchaseNumber(string $purchaseNumber): void
    {
        $this->purchaseNumber = $purchaseNumber;
    }

    /**
     * @return User
     */
    public function getBuyerUser(): User
    {
        return $this->buyerUser;
    }

    /**
     * @param User $buyerUser
     */
    public function setBuyerUser(User $buyerUser): void
    {
        $this->buyerUser = $buyerUser;
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

}
