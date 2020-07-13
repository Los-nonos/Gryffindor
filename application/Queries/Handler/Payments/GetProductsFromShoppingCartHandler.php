<?php


namespace Application\Queries\Handler\Payments;


use Application\Queries\Query\Payments\GetProductsFromShoppingCartQuery;
use Application\Queries\Results\Payments\GetProductsFromShoppingCartResult;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class GetProductsFromShoppingCartHandler implements HandlerInterface
{
    /**
     * @var ProductServiceInterface
     */
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $service)
    {
        $this->productService = $service;
    }

    /**
     * @param GetProductsFromShoppingCartQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $productsList = [];
        $products = $query->getProducts();

        foreach ($products as $product) {
            $productEntity = $this->productService->findOneByIdOrFail($product['id']);

            array_push($productsList, [ 'product' => $productEntity, 'quantity' => $product['quantity'] ]);
        }

        return new GetProductsFromShoppingCartResult($productsList);
    }
}
