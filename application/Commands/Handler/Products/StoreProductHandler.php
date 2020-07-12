<?php


namespace Application\Commands\Handler\Products;


use Application\Commands\Command\Products\StoreProductCommand;
use Domain\Entities\Order;
use Domain\Entities\Product;
use Domain\Entities\PurchaseOrder;
use Domain\Entities\Stock;
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
        $product->setTitle($command->getName());
        $product->setDescription($command->getDescription());
        $product->setPrice($command->getPrice());
        $stock = new Stock();
        $stock->setQuantity($command->getStock());
        $stock->setRemanentQuantity($command->getStock());
        $product->setStock($stock);
        $product->setTaxes($command->getIva());
        //$product->setBrand($command->getBrands()); Corregir BRAND
        $purchase = new PurchaseOrder();
        $purchase->setPurchaseNumber($command->getPurchaseNumber());
        $product->set

        $this->productService->persist($product);

    }

}
