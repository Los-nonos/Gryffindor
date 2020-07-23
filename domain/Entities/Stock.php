<?php


namespace Domain\Entities;


use Application\Exceptions\StockInvalidQuantity;
use http\Exception\InvalidArgumentException;
use phpDocumentor\Reflection\DocBlock\Serializer;

class Stock
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var Product
     */
    private Product $product;

    /**
     * @var int
     */
    private int $quantity;

    /**
     * @var int
     */
    private int $remanentQuantity;

    /**
     * @var array
     */
    private array $brands;

    /**
     * @var array
     */
    private array $reserved;

    /**
     * @var array
     */
    private array $categories;

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
        if($quantity <= 0) {
            throw new StockInvalidQuantity();
        }

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

    /**
     * @return array
     */
    public function getBrands() : array
    {
        return $this->brands;
    }

    /**
     * @param string $brand
     */
    public function setBrands(string $brand) : void
    {
        $this->brands = serialize($brand);
    }

    /**
     * @return array
     */
    private function getReservations() : array
    {
        return $this->reserved;
    }

    /**
     * @param string $reservation
     */
    public function setReservation(string $reservation) : void
    {
        $this->reserved = serialize($reservation);
    }

    /**
     * @return array
     */
    public function getCategories() : array
    {
        return $this->categories;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category) : void
    {
        $this->categories = serialize($category);
    }

    //TODO TERMINAR CON LAS RELACIONES ENTRE ENTIDADES
}
