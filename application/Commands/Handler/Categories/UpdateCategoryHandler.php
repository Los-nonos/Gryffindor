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

        $this->categoryService->persist($category);
    }
}
