<?php


namespace Application\Commands\Command\Customers;


use DateTime;
use Infrastructure\CommandBus\Command\CommandInterface;

class StoreCustomerCommand implements CommandInterface
{
    private string $name;
    private string $surname;
    private string $email;
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
    private int $age;

    /**
     * UpdateCustomerCommand constructor.
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $vatCondition
     * @param int $age
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
        string $name,
        string $surname,
        string $email,
        string $vatCondition,
        int $age,
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
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->age = $age;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getVatCondition(): string
    {
        return $this->vatCondition;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
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
}
