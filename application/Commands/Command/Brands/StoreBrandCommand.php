<?php


namespace Application\Commands\Command\Brands;


use Infrastructure\CommandBus\Command\CommandInterface;

class StoreBrandCommand implements CommandInterface
{
    private string $name;
    private ?string $description;

    public function __construct(
        string $name,
        ?string $description
    )
    {
        $this->name = $name;
        $this->description = $description;
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
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
