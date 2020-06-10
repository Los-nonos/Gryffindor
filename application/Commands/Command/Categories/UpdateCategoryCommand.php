<?php


namespace Application\Commands\Command\Categories;


use Infrastructure\CommandBus\Command\CommandInterface;

class UpdateCategoryCommand implements CommandInterface
{
    private $id;
    private $name;
    private $filters;

    public function __construct(
        $id,
        $name,
        $filters
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->filters = $filters;
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

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
