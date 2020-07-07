<?php


namespace Domain\Entities;


use DateTime;
use Ramsey\Uuid\Uuid;

class Customer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int
     */
    private $age;

    /**
     * @var string
     */
    private $cellPhone;

    /**
     * @var string
     */
    private $dni;

    /**
     * @var DateTime
     */
    private $birthday;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $vatCondition;

    /**
     * @var string
     */
    private $taxationKey;

    /**
     * @var string
     */
    private $grossIncome;

    /**
     * @var Order[]
     */
    private $orders;

    public function __construct()
    {
        //$this->uuid = Uuid::uuid4();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->cellPhone;
    }

    /**
     * @param string $cellPhone
     */
    public function setPhoneNumber(string $cellPhone): void
    {
        $this->cellPhone = $cellPhone;
    }

    /**
     * @return string
     */
    public function getDni(): ?string
    {
        return $this->dni;
    }

    /**
     * @param string $dni
     */
    public function setDni(string $dni): void
    {
        $this->dni = $dni;
    }

    /**
     * @return DateTime
     */
    public function getBirthday(): ?DateTime
    {
        return $this->birthday;
    }

    /**
     * @param DateTime $birthday
     */
    public function setBirthday(DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getVatCondition(): ?string
    {
        return $this->vatCondition;
    }

    /**
     * @param string $vatCondition
     */
    public function setVatCondition(string $vatCondition): void
    {
        $this->vatCondition = $vatCondition;
    }

    /**
     * @return string
     */
    public function getTaxationKey(): ?string
    {
        return $this->taxationKey;
    }

    /**
     * @param string $taxationKey
     */
    public function setTaxationKey(?string $taxationKey): void
    {
        $this->taxationKey = $taxationKey;
    }

    /**
     * @return string
     */
    public function getGrossIncome(): ?string
    {
        return $this->grossIncome;
    }

    /**
     * @param string $grossIncome
     */
    public function setGrossIncome(?string $grossIncome): void
    {
        $this->grossIncome = $grossIncome;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param Order[] $orders
     */
    public function setOrders(array $orders): void
    {
        $this->orders = $orders;
    }
}
