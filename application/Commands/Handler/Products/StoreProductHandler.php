<?php


namespace Application\Commands\Handler\Products;


use Application\Commands\Command\Products\StoreProductCommand;
use Domain\Entities\Product;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreProductHandler implements HandlerInterface
{
    private ProductServiceInterface $productService;
    public function __construct
    (
        ProductServiceInterface $productServiceInterface
    )
    {
        $this->productService = $productServiceInterface;
    }

    /**
     * @param StoreProductCommand $command
     */
    public function handle($command) : void
    {
        $product = new Product();
        $this->productService->persist($product);
    }

}
