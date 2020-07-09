<?php


namespace Application\Queries\Handler\Stock;


use Application\Queries\Query\Stock\FindProductStockQuery;
use Application\Queries\Results\Stock\FindProductStockResult;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindProductStockHandler implements HandlerInterface
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param FindProductStockQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $product = $this->productService->findOneByIdOrFail($query->getId());

        $stock = $product->getStock();

        return new FindProductStockResult($stock);
    }
}
