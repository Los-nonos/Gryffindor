<?php


namespace Domain\Entities;


class Employee
{
    /**
     * @var int
     *
     */
    private int $id;

    /**
     * @var string
     */
    private string $role;

    public function __construct(string $role)
    {
        $this->role = $role;
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
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}
