<?php


namespace Application\Commands\Handler\Categories;


use Application\Commands\Command\Categories\StoreCategoryCommand;
use Application\Services\Category\CategoryServiceInterface;
use Application\Services\Filters\FilterServiceInterface;
use Domain\Entities\Category;
use Domain\Entities\Filter;
use Domain\Entities\FilterOption;
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

        $this->categoryService->persist($category);
    }
}
