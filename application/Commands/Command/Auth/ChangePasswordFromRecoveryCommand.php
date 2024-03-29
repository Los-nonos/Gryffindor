<?php


namespace Application\Commands\Command\Auth;


use Infrastructure\CommandBus\Command\CommandInterface;

class ChangePasswordFromRecoveryCommand implements CommandInterface
{
    private string $password;
    private string $email;

    /**
     * ChangePasswordCommand constructor.
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->password = $password;
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
