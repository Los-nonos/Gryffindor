<?php


namespace Application\Commands\Handler\Categories;


use Application\Commands\Command\Categories\DestroyCategoryCommand;
use Application\Services\Category\CategoryServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class DestroyCategoryHandler implements HandlerInterface
{
    private CategoryServiceInterface $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param DestroyCategoryCommand $command
     */
    public function handle($command): void
    {
        $category = $this->categoryService->findOneByIdOrFail($command->getId());

        $this->categoryService->destroy($category);
    }
}
