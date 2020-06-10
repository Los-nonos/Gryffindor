<?php


namespace Application\Commands\Command\Categories;


use Infrastructure\CommandBus\Command\CommandInterface;

class DestroyCategoryCommand implements CommandInterface
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }
}
