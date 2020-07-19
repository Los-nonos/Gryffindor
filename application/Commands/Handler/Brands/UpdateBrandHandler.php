<?php


namespace Application\Commands\Handler\Brands;


use Application\Commands\Command\Brands\UpdateBrandCommand;
use Domain\Interfaces\Services\Brands\BrandServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class UpdateBrandHandler implements HandlerInterface
{
    private BrandServiceInterface $brandService;

    public function __construct(BrandServiceInterface $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * @param UpdateBrandCommand $command
     */
    public function handle($command): void
    {
        $brand = $this->brandService->findOneByIdOrFail($command->getId());

        $brand->setName($command->getName());
        $brand->setDescription($command->getDescription());

        $this->brandService->persist($brand);
    }
}
