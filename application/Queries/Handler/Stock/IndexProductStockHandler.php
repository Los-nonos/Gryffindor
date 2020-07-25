<?php


namespace Application\Queries\Handler\Stock;


use Application\Queries\Query\Stock\IndexProductStockQuery;
use Application\Queries\Results\Stock\IndexProductStockResult;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexProductStockHandler implements HandlerInterface
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param IndexProductStockQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $products = $this->productService->findAll($query->getPage(), $query->getSize());

        if (!$query->getMinValue()) {
            return new IndexProductStockResult($products);
        }

        $productList = [];

        foreach ($products as $product) {
            if($product->getStock()->getQuantity() <= $query->getMinValue()) {
                array_push($productList, $product);
            }
        }

        return new IndexProductStockResult($productList);
    }
}
