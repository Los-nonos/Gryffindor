<?php


namespace Application\Commands\Command\Products;


use Infrastructure\CommandBus\Command\CommandInterface;
use Money\Money;

class UpdateProductCommand implements CommandInterface
{
    private int $id;
    private string $name;
    private string $description;
    private int $price;
    private array $categories;
    private int $stock;
    private int $taxes;
    private array $brands;
    private array $characteristics;
    private string $purchaseOrder;
    private int $providerId;
    private array $images;

    public function __construct
    (
        int $id,
        string $name,
        string $description,
        array $images,
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
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->images = $images;
        $this->price = $price * 100;
        $this->categories = $categories;
        $this->stock = $stock;
        $this->taxes = $taxes * 100;
        $this->brands = $brands;
        $this->characteristics = $characteristics;
        $this->purchaseOrder = $purchaseOrder;
        $this->providerId = $providerId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): Money
    {
        return Money::ARS($this->price);
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getTaxes(): Money
    {
        return Money::ARS($this->taxes);
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

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return string
     */
    public function getPurchaseOrder(): string
    {
        return $this->purchaseOrder;
    }
}
