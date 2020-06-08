<?php


namespace Domain\Entities;


class Stock
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var int
     */
    private $remanentQuantity;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getRemanentQuantity(): int
    {
        return $this->remanentQuantity;
    }

    /**
     * @param int $remanentQuantity
     */
    public function setRemanentQuantity(int $remanentQuantity): void
    {
        $this->remanentQuantity = $remanentQuantity;
    }
}
