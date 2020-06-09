<?php


namespace Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

class Product
{
    /**
     * @var int
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $taxes;

    /**
     * @var Category[]
     */
    private $categories;

    /**
     * @var Stock
     */
    private $stock;

    /**
     * @var Characteristic[]
     */
    private $characteristics;

    /**
     * @var Order[]
     */
    private $orders;

    /**
     * Product constructor.
     */
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getTaxes(): float
    {
        return $this->taxes;
    }

    /**
     * @param float $taxes
     */
    public function setTaxes(float $taxes): void
    {
        $this->taxes = $taxes;
    }

    /**
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param Category $categories
     */
    public function setCategories(Category $categories): void
    {
        $this->categories[] = $categories;
    }

    /**
     * @return Stock
     */
    public function getStock(): Stock
    {
        return $this->stock;
    }

    /**
     * @param Stock $stock
     */
    public function setStock(Stock $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return Characteristic[]
     */
    public function getCharacteristics(): array
    {
        return $this->characteristics;
    }

    /**
     * @param Characteristic $characteristics
     */
    public function addCharacteristics(Characteristic $characteristics): void
    {
        $this->characteristics[] = $characteristics;
    }
}
