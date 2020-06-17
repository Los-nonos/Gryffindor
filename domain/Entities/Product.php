<?php


namespace Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Arr;

class Product
{
    /**
     * @var int
     * @ORM\Id
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var float
     */
    private float $price;

    /**
     * @var float
     */
    private float $iva;

    /**
     * @var ArrayCollection
     */
    private ArrayCollection $categories;

    /**
     * @var int
     */
    private int $stock;

    /**
     * @var ArrayCollection
     */
    private ArrayCollection $characteristics;

    /**
     * @var ArrayCollection
     */
    private ArrayCollection $orders;

    /**
     * @var ArrayCollection .
     */
    private ArrayCollection $providers;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string name
     */
    public function setTitle(string $name): void
    {
        $this->name = $name;
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
    public function getIva(): float
    {
        return $this->iva;
    }

    /**
     * @param float $iva
     */
    public function setIva(float $iva): void
    {
        $this->iva = $iva;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories(): ArrayCollection
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
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return ArrayCollection
     */
    public function getCharacteristics(): ArrayCollection
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
