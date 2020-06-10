<?php


namespace Application\Commands\Handler\Categories;


use Application\Commands\Command\Categories\UpdateCategoryCommand;
use Application\Services\Category\CategoryServiceInterface;
use Application\Services\Filters\FilterServiceInterface;
use Domain\Entities\Category;
use Domain\Entities\Filter;
use Domain\Entities\FilterOption;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class UpdateCategoryHandler implements HandlerInterface
{
    private CategoryServiceInterface $categoryService;

    private FilterServiceInterface $filterService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        FilterServiceInterface $filterService)
    {
        $this->categoryService = $categoryService;
        $this->filterService = $filterService;
    }

    /**
     * @param UpdateCategoryCommand $command
     */
    public function handle($command): void
    {
        $category = $this->categoryService->findOneByIdOrFail($command->getId());

        $category->setName($command->getName());
        $category = $this->modifyFilters($category, $command->getFilters());

        $this->categoryService->persist($category);
    }

    private function modifyFilters(Category $category, array $filters)
    {
        $filterSaved = $category->getFilters();

        // TODO : refactor this grap
        foreach ($filterSaved as $item) {
            $this->filterService->destroy($item);
        }

        foreach ($filters as $filter) {
            $objectFilter = new Filter();
            $objectFilter->setCategory($category);
            $objectFilter->setName($filter['name']);

            foreach ($filter['options'] as $option) {
                $optionObject = new FilterOption();
                $optionObject->setName($option);
                $optionObject->setFilter($objectFilter);
                $objectFilter->addOption($optionObject);
            }

            $category->addFilters($objectFilter);
        }

        return $category;
    }
}
