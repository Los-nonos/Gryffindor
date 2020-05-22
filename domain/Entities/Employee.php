<?php


namespace Domain\Entities;


class Employee
{
    private string $role;

    public function __construct(string $role)
    {
        $this->role = $role;
    }
}
