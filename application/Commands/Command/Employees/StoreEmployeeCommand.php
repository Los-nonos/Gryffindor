<?php


namespace Application\Commands\Command\Employees;


use Infrastructure\CommandBus\Command\CommandInterface;

class StoreEmployeeCommand implements CommandInterface
{
    private string $name;
    private string $surname;
    private string $role;
    private string $username;
    private string $password;
    private string $email;

    public function __construct(
        string $name,
        string $surname,
        string $role,
        string $username,
        string $password,
        string $email
    )
    {
        $this->role = $role;
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
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
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
