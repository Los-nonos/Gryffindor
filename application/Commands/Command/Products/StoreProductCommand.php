<?php


namespace Application\Commands\Command\Products;


use Infrastructure\CommandBus\Command\CommandInterface;

class StoreProductCommand implements CommandInterface
{

    private string $name;
    private string $description;
    private float $price;
    private array $categories;
    private int $stock;
    private float $taxes;
    private array $brands;
    private array $characteristics;
    private string $purchaseOrder;
    private int $providerId;


    public function __construct
    (
        string $name,
        string $description,
        float $price,
        array $categories,
        int $stock,
        float $taxes,
        array $brands,
        array $characteristics,
        string $purchaseOrder,
        int $providerId
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->categories = $categories;
        $this->stock = $stock;
        $this->taxes = $taxes;
        $this->brands = $brands;
        $this->characteristics = $characteristics;
        $this->purchaseOrder = $purchaseOrder;
        $this->providerId = $providerId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getTaxes(): float
    {
        return $this->taxes;
    }

    public function getBrands() : array
    {
        return $this->brands;
    }

    public function getCharacteristics() : array
    {
        return $this->characteristics;
    }

    public function getPurchaseNumber() : string
    {
        return $this->purchaseOrder;
    }

    public function getProviderId() : int
    {
        return $this->providerId;
    }

}
