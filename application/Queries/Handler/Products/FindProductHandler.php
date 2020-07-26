<?php


namespace Application\Queries\Handler\Products;


use Application\Queries\Query\Products\FindProductQuery;
use Application\Queries\Results\Products\FindProductResult;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindProductHandler implements HandlerInterface
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param FindProductQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $product = $this->productService->findOneByIdOrFail($query->getId());

        return new FindProductResult($product);
    }
}
