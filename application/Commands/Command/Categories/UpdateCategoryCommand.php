<?php


namespace Application\Commands\Command\Categories;


use Infrastructure\CommandBus\Command\CommandInterface;

class UpdateCategoryCommand implements CommandInterface
{
    private $id;
    private $name;

    public function __construct(
        $id,
        $name
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
