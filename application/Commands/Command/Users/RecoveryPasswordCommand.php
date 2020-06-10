<?php


namespace Application\Commands\Command\Users;


use Infrastructure\CommandBus\Command\CommandInterface;

class RecoveryPasswordCommand implements CommandInterface
{

    private string $email;

    /**
     * RecoveryPasswordCommand constructor.
     * @param string $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
