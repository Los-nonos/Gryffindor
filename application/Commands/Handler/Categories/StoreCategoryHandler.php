<?php


namespace Application\Commands\Handler\Categories;


use Application\Commands\Command\Categories\StoreCategoryCommand;
use Application\Services\Category\CategoryServiceInterface;
use Domain\Entities\Category;
use Domain\Entities\Filter;
use Domain\Entities\FilterOption;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreCategoryHandler implements HandlerInterface
{
    private CategoryServiceInterface $categoryService;

    public function __construct(
        CategoryServiceInterface $categoryService
    )
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param StoreCategoryCommand $command
     */
    public function handle($command): void
    {
        $category = new Category();
        $category->setName($command->getName());

        $filters = $command->getFilters();

        foreach ($filters as $filter) {
            $objectFilter = new Filter();
            //$objectFilter->setCategory($category);
            $objectFilter->setName($filter['name']);

            foreach ($filter['options'] as $option) {
                $optionObject = new FilterOption();
                $optionObject->setName($option);
                $objectFilter->addOption($optionObject);
            }

            $category->addFilters($objectFilter);
        }

        $this->categoryService->persist($category);
    }
}
