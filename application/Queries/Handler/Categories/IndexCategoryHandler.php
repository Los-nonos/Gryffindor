<?php


namespace Application\Queries\Handler\Categories;


use Application\Queries\Query\Categories\IndexCategoryQuery;
use Application\Queries\Results\Categories\IndexCategoryResult;
use Application\Services\Category\CategoryServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexCategoryHandler implements HandlerInterface
{
    private CategoryServiceInterface $categoryService;

    public function __construct(
        CategoryServiceInterface $categoryService
    )
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param IndexCategoryQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $categories = $this->categoryService->indexAndPaginated($query->getPage(), $query->getSize());
        $result = new IndexCategoryResult();
        $result->setCategories($categories);
        return $result;
    }
}
