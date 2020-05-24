<?php


namespace Domain\Entities;


use Domain\Enums\AdminRoles;

class Admin
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $role;

    public function __construct()
    {
        $this->role = AdminRoles::ADMIN;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setRole(string $role)
    {
        $this->role = $role;
    }

    public function getRole(): string
    {
        return $this->role;
    }
}
