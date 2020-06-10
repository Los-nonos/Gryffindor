<?php


namespace Application\Commands\Command\Customers;


use Infrastructure\CommandBus\Command\CommandInterface;

class StoreWebCustomerCommand implements CommandInterface
{
    private string $name;
    private string $surname;
    private string $username;
    private string $email;
    private string $password;

    /**
     * CreateWebCustomerCommand constructor.
     * @param string $name
     * @param string $surname
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(
        string $name,
        string $surname,
        string $username,
        string $email,
        string $password
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
