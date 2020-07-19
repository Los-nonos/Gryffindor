<?php


namespace Application\Commands\Handler\Brands;


use Application\Commands\Command\Brands\StoreBrandCommand;
use Domain\Entities\Brand;
use Domain\Interfaces\Services\Brands\BrandServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreBrandHandler implements HandlerInterface
{
    private BrandServiceInterface $service;

    public function __construct(BrandServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param StoreBrandCommand $command
     */
    public function handle($command): void
    {
        $brand = new Brand();
        $brand->setName($command->getName());
        $brand->setDescription($command->getDescription());

        $this->service->persist($brand);
    }
}
