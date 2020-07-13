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
    private float $iva;
    private array $brand;
    private array $characteristics;
    private string $order;
    private array $provider;


    public function __construct
    (
        string $name,
        string $description,
        float $price,
        array $categories,
        int $stock,
        float $iva,
        array $brand,
        array $characteristics,
        string $order,
        array $provider
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->categories = $categories;
        $this->stock = $stock;
        $this->iva = $iva;
        $this->brand = $brand;
        $this->characteristics = $characteristics;
        $this->order = $order;
        $this->provider = $provider;
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

    public function getIva(): float
    {
        return $this->iva;
    }

    public function getBrands() : array
    {
        return $this->brand;
    }

    public function getCharacteristics() : array
    {
        return $this->characteristics;
    }

    public function getOrder() : string
    {
        return $this->order;
    }

    public function getProvider() : array
    {
        return $this->provider;
    }

}
