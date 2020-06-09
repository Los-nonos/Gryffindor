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
     * @var array
     */
    private $filters;

    /**
     * StoreCategoryCommand constructor.
     * @param string $name
     * @param array $filters
     */
    public function __construct(string $name, array $filters)
    {
        $this->name = $name;
        $this->filters = $filters;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }
}
