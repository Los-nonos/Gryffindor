<?php


namespace Application\Commands\Command\Auth;


class RenewTokenCommand
{
    /**
     * @var string
     */
    private $token;

    /**
     * RenewTokenCommand constructor.
     * @param mixed $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
