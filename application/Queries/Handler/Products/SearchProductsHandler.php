<?php


namespace Application\Queries\Handler\Products;


use Application\Queries\Query\Products\SearchProductsQuery;
use Application\Queries\Results\Products\ProductListResult;
use Application\Services\Category\CategoryServiceInterface;
use Domain\Interfaces\Services\Brands\BrandServiceInterface;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class SearchProductsHandler implements HandlerInterface
{
    private ProductServiceInterface $productService;

    private CategoryServiceInterface $categoryService;

    private BrandServiceInterface $brandService;

    public function __construct(
        ProductServiceInterface $productService,
        CategoryServiceInterface $categoryService,
        BrandServiceInterface $brandService
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
    }

    /**
     * @param SearchProductsQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        if (!$query->getQuery() && !$query->getCategories() && !$query->getBrands() && !$query->getProviders()) {
            $products = $this->productService->findAll($query->getPage(), $query->getSize());
            return new ProductListResult($products);
        }

        $queryInput = null;
        $brandIds = [];
        $categoriesIds = [];

        if (!empty($query->getQuery())) {
            $queryInput = $query->getQuery();
        }

        foreach ($query->getBrands() as $brandId) {
            $brand = $this->brandService->findOneByIdOrFail($brandId);
            $brandIds[] = $brand->getId();
        }

        foreach ($query->getCategories() as $categoryId) {
            $category = $this->categoryService->findOneByIdOrFail($categoryId);
            $categoriesIds[] = $category->getId();
        }

        $products = $this->productService->findByQuery($queryInput, $categoriesIds, $brandIds, [], $query->getPage(), $query->getSize(), $query->getOrderBy());

        return new ProductListResult($products);
    }
}
