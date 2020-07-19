<?php


namespace Application\Commands\Command\Providers;


use Infrastructure\CommandBus\Command\CommandInterface;

class StoreProviderCommand implements CommandInterface
{
    private string $name;
    private ?string $businessName;
    private ?string $zipCode;
    private ?string $address;
    private ?string $phoneNumber;
    private ?string $observations;

    /**
     * StoreProviderCommand constructor.
     * @param string $name
     * @param string|null $businessName
     * @param string|null $phoneNumber
     * @param string|null $zipCode
     * @param string|null $address
     * @param string|null $observations
     */
    public function __construct($name, $businessName, $phoneNumber, $zipCode, $address, $observations)
    {
        $this->name = $name;
        $this->businessName = $businessName;
        $this->zipCode = $zipCode;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->observations = $observations;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    /**
     * @return string|null
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getObservations(): ?string
    {
        return $this->observations;
    }
}
