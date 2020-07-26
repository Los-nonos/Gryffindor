<?php


namespace Application\Commands\Handler\Products;


use Application\Commands\Command\Products\UpdateProductCommand;
use Domain\Entities\PurchaseOrder;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class UpdateProductHandler implements HandlerInterface
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param UpdateProductCommand $command
     * @throws \Application\Exceptions\StockInvalidQuantity
     */
    public function handle($command): void
    {
        $product = $this->productService->findOneByIdOrFail($command->getId());

        $product->setTitle($command->getName());
        $product->setDescription($command->getDescription());
        $product->setPrice($command->getPrice());
        $stock = $product->getStock();

        $stock->setQuantity($command->getStock());
        $stock->setRemanentQuantity($command->getStock());
        $product->setStock($stock);
        $product->setTaxes($command->getTaxes());

        $purchase = new PurchaseOrder();
        $purchase->setPurchaseNumber($command->getPurchaseNumber());
        $purchases = $product->getPurchaseOrder();
        array_push($purchases, $purchase);
        $product->setPurchaseOrder($purchases);

        $this->productService->persist($product);
    }
}
