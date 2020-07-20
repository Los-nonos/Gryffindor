<?php


namespace Domain\Entities;

class Provider
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private ?string $address;

    private string $businessName;

    private ?string $phoneNumber;

    private ?string $zipCode;

    private ?string $observations;

    /**
     * @var array
     */
    private $brands;

    /**
     * @return array
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param array $orders
     */
    public function setOrders(array $orders): void
    {
        $this->orders = $orders;
    }

    /**
     * @var array
     */
    private $products;

    /**
     * @var array
     */
    private $orders;

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
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getBusinessName(): string
    {
        return $this->businessName;
    }

    /**
     * @param string $businessName
     */
    public function setBusinessName(string $businessName): void
    {
        $this->businessName = $businessName;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(?string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getObservations(): ?string
    {
        return $this->observations;
    }

    /**
     * @param string $observations
     */
    public function setObservations(?string $observations): void
    {
        $this->observations = $observations;
    }

    /**
     * @return array
     */
    public function getBrands(): array
    {
        return $this->brands;
    }

    /**
     * @param array $brands
     */
    public function setBrands(array $brands): void
    {
        $this->brands = $brands;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param array $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }
}
