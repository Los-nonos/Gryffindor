<?php


namespace Application\Commands\Command\Customers;


use DateTime;
use Infrastructure\CommandBus\Command\CommandInterface;

class UpdateCustomerCommand implements CommandInterface
{
    private int $id;
    private DateTime $birthday;
    private string $country;
    private string $state;
    private string $city;
    private string $postalCode;
    private string $cellPhone;
    private string $vatCondition;
    private string $dni;
    private ?string $taxationKey;
    private ?string $grossIncome;

    /**
     * UpdateCustomerCommand constructor.
     * @param int $id
     * @param string $vatCondition
     * @param DateTime $birthday
     * @param string $country
     * @param string $state
     * @param string $city
     * @param string $postalCode
     * @param string $cellPhone
     * @param string $dni
     * @param string|null $taxationKey
     * @param string|null $grossIncome
     */
    public function __construct(
        int $id,
        string $vatCondition,
        DateTime $birthday,
        string $country,
        string $state,
        string $city,
        string $postalCode,
        string $cellPhone,
        string $dni,
        ?string $taxationKey,
        ?string $grossIncome
    )
    {
        $this->id = $id;
        $this->vatCondition = $vatCondition;
        $this->birthday = $birthday;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->cellPhone = $cellPhone;
        $this->dni = $dni;
        $this->taxationKey = $taxationKey;
        $this->grossIncome = $grossIncome;
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
    public function getVatCondition(): string
    {
        return $this->vatCondition;
    }

    /**
     * @return DateTime
     */
    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCellPhone(): string
    {
        return $this->cellPhone;
    }

    /**
     * @return string
     */
    public function getDni(): string
    {
        return $this->dni;
    }

    /**
     * @return string|null
     */
    public function getTaxationKey(): ?string
    {
        return $this->taxationKey;
    }

    /**
     * @return string|null
     */
    public function getGrossIncome(): ?string
    {
        return $this->grossIncome;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return 0;
    }
}
