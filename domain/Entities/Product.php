<?php


namespace Domain\Entities;

class Product
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $title;

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
    private float $taxes;

    /**
     * @var array
     */
    private $categories;

    /**
     * @var array
     */
    private $brands;

    /**
     * @var Stock
     */
    private Stock $stock;

    /**
     * @var array
     */
    private $characteristics;

    /**
     * @var array
     */
    private $orders;

    /**
     * @var array .
     */
    private $providers;

    /**
     * @var array
     */
    private $purchaseOrder;

    /**
     * @var bool
     */
    private bool $featured;

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
     * @return array
     */
    public function getPurchaseOrder(): array
    {
        return $this->purchaseOrder;
    }

    /**
     * @param PurchaseOrder $purchaseOrder
     */
    public function setPurchaseOrder(PurchaseOrder $purchaseOrder): void
    {
        $this->purchaseOrder = $purchaseOrder;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string name
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
     * @param float $iva
     */
    public function setTaxes(float $iva): void
    {
        $this->taxes = $iva;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return bool
     */
    public function isFeatured(): bool
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     */
    public function setFeatured(bool $featured): void
    {
        $this->featured = $featured;
    }

    /**
     * @param Category $categories
     */
    public function addCategories(Category $categories): void
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
     * @return array
     */
    public function getCharacteristics()
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
    public function getAvailability(): bool
    {
        return $this->available;
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @param bool $available
     */
    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }


    /**
     * @param bool $notAvailable
     */
    public function setNotAvailable(bool $notAvailable): void
    {
        $this->available = $notAvailable;
    }

    /**
     * @return array
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param Order $newOrder
     */
    public function setOrder(Order $newOrder) : void
    {
        $this->orders[] = $newOrder;
    }

    /**
     * @return array
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * @param Provider $newProvider
     */
    public function setProvider(Provider $newProvider) : void
    {
        $this->providers[] = $newProvider;
    }

    /**
     * @return array
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * @param Brand $newBrand
     */
    public function setBrand(Brand $newBrand) : void
    {
        $this->brands[] = $newBrand;
    }
}
