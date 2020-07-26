<?php


namespace Application\Commands\Command\Products;


use Infrastructure\CommandBus\Command\CommandInterface;

class DestroyProductCommand implements CommandInterface
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
