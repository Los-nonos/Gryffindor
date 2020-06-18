<?php


namespace Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

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
     * @var bool
     */
    private bool $available;

    /**
     * @var float
     */
    private float $price;

    /**
     * @var float
     */
    private float $iva;

    /**
     * @var array
     */
    private array $categoriesId;

    /**
     * @var array
     */
    private array $brandsId;

    /**
     * @var int
     */
    private int $stock;

    /**
     * @var array
     */
    private array $characteristics;

    /**
     * @var array
     */
    private array $ordersId;

    /**
     * @var array .
     */
    private array $providersId;

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
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categoriesId;
    }

    /**
     * @param Category $categories
     */
    public function setCategories(Category $categories): void
    {
        $this->categoriesId[] = $categories;
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
     * @return array
     */
    public function getCharacteristics(): array
    {
        return $this->characteristics;
    }

    /**
     * @param Characteristic $characteristics
     */
    public function setCharacteristics(Characteristic $characteristics): void
    {
        $this->characteristics[] = $characteristics;
    }

    /**
     * @return bool
     */
    public function getAvailability() : bool
    {
        return $this->available;
    }

    /**
     * @param bool $notAvailable
     */
    public function setNotAvailable(bool $notAvailable) : void
    {
        $this->available = $notAvailable;
    }

    /**
     * @return array
     */
    public function getOrders() : array
    {
        return $this->ordersId;
    }

    /**
     * @param Order $newOrder
     */
    public function setOrder(Order $newOrder) : void
    {
        $this->ordersId [] =$newOrder;
    }

    /**
     * @return array
     */
    public function getProviders() : array
    {
        return $this->providersId;
    }

    /**
     * @param Provider $newProvider
     */
    public function setProvider(Provider $newProvider) : void
    {
        $this->providersId [] = $newProvider;
    }

    /**
     * @return array
     */
    public function getBrands() : array
    {
        return $this->brandsId;
    }

    /**
     * @param Brand $newBrand
     */
    public function setBrand(Brand $newBrand) : void
    {
        $this->brandsId[] = $newBrand;
    }
}
