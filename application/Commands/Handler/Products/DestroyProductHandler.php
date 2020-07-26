<?php


namespace Application\Commands\Handler\Products;


use Application\Commands\Command\Products\DestroyProductCommand;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class DestroyProductHandler implements HandlerInterface
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }


    /**
     * @param DestroyProductCommand $command
     */
    public function handle($command): void
    {
        $product = $this->productService->findOneByIdOrFail($command->getId());

        $this->productService->destroy($product);
    }
}
