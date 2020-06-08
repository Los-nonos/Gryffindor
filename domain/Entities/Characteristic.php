<?php


namespace Domain\Entities;


class Characteristic
{
    /**
     * @var int
     */
    private $id;

    /**
     * this is a Filter name
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $property;

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
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * @param string $property
     */
    public function setProperty(string $property): void
    {
        $this->property = $property;
    }
}
