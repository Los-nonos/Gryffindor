<?php


namespace Domain\Entities;


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

    public function __construct()
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
