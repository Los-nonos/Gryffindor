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
    private array $brands;
    private array $characteristics;
    private array $orders;
    private array $providers;


    public function __construct
    (
        string $name,
        string $description,
        float $price,
        array $categories,
        int $stock,
        float $iva,
        array $brands,
        array $characteristics,
        array $orders,
        array $providers
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->categories = $categories;
        $this->stock = $stock;
        $this->iva = $iva;
        $this->brands = $brands;
        $this->characteristics = $characteristics;
        $this->orders = $orders;
        $this->providers = $providers;
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
        return $this->brands;
    }

    public function getCharacteristics() : array
    {
        return $this->characteristics;
    }

    public function getOrder() : array
    {
        return $this->orders;
    }

    public function getProvider() : array
    {
        return $this->providers;
    }

}
