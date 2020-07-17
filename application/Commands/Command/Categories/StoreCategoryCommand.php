<?php


namespace Application\Commands\Command\Categories;


use Infrastructure\CommandBus\Command\CommandInterface;

class StoreCategoryCommand implements CommandInterface
{

    /**
     * @var string
     */
    private $name;

    /**
     * StoreCategoryCommand constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
