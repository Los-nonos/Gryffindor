<?php


namespace Application\Commands\Command\Users;


class CreateUserCommand
{
    private string $name;
    private string $surname;
    private string $username;
    private string $password;
    private string $email;

    /**
     * CreateUserCommand constructor.
     * @param string $name
     * @param string $surname
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function __construct(
        string $name,
        string $surname,
        string $username,
        string $password,
        string $email)
    {
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
