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
        if (!$query->getQuery() && !$query->getCategories() && !$query->getBrands() && !$query->getProviders() && !$query->getMinPrice() && !$query->getMaxPrice()) {
            $products = $this->productService->findAll($query->getPage(), $query->getSize());
            $totalCount = $this->productService->count();
            return new ProductListResult($products, $totalCount);
        }

        $queryInput = null;
        $brandIds = [];
        $categoriesIds = [];
        $minPrice = 0;
        $maxPrice = null;

        if (!empty($query->getQuery())) {
            $queryInput = $query->getQuery();
        }

        if($query->getBrands()) {
            foreach ($query->getBrands() as $brandId) {
                $brand = $this->brandService->findOneByIdOrFail($brandId);
                $brandIds[] = $brand->getId();
            }
        }

        if($query->getCategories()) {
            foreach ($query->getCategories() as $categoryId) {
                $category = $this->categoryService->findOneByIdOrFail($categoryId);
                $categoriesIds[] = $category->getId();
            }
        }

        if($query->getMinPrice()) {
            $minPrice = $query->getMinPrice();
        }

        if($query->getMaxPrice()) {
            $maxPrice = $query->getMaxPrice();
        }

        $products = $this->productService->findByQuery($queryInput, $categoriesIds, $brandIds, [], $query->getPage(), $query->getSize(), $query->getOrderBy(), $minPrice, $maxPrice);
        $totalCount = $this->productService->count();

        return new ProductListResult($products, $totalCount);
    }
}
