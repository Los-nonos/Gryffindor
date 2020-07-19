<?php


namespace Application\Commands\Command\Brands;


use Infrastructure\CommandBus\Command\CommandInterface;

class UpdateBrandCommand implements CommandInterface
{
    private int $id;
    private string $name;
    private ?string $description;

    public function __construct(
        int $id,
        string $name,
        ?string $description
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
