<?php


namespace Application\Commands\Command\Providers;


use Infrastructure\CommandBus\Command\CommandInterface;

class DestroyProviderCommand implements CommandInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
