<?php


namespace Application\Commands\Command\Users;


use Infrastructure\CommandBus\Command\CommandInterface;

class DisableUserCommand implements CommandInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }
}
