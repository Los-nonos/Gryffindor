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
     * @param string|array $role
     */
    public function setRole($role): void
    {
        //TODO: cambiar a booleans con todos los roles o verificar que los roles ingresados sean correctos con el enum
        if(is_array($role))
        {
            $role = json_encode($role);
        }
        else {
            $role = json_encode([$role]);
        }

        $this->role = $role;
    }
}
