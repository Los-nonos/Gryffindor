<?php


namespace Application\Commands\Handler\Products;


use Application\Commands\Command\Products\StoreProductCommand;
use Infrastructure\CommandBus\Handler\HandlerInterface;
use Infrastructure\Persistence\Repositories\ProductRepository;

class StoreProductHandler implements HandlerInterface
{
    private ProductRepository $productRepository;

    /**
     * StoreProductHandler constructor.
     * @param ProductRepository $repository
     */
    public function __construct
    (
        ProductRepository $repository
    )
    {
        $this->productRepository = $repository;
    }

    /**
     * @param StoreProductCommand $command
     */
    public function handle($command) : void
    {
        //TODO FINISH HANDLER AND PERSIST
    }

}
