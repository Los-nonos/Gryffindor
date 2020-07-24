<?php


namespace Application\Commands\Handler\Brands;


use Application\Commands\Command\Brands\DestroyBrandCommand;
use Domain\Interfaces\Services\Brands\BrandServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class DestroyBrandHandler implements HandlerInterface
{
    private BrandServiceInterface $brandService;

    public function __construct(BrandServiceInterface $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * @param DestroyBrandCommand $command
     */
    public function handle($command): void
    {
        $brand = $this->brandService->findOneByIdOrFail($command->getId());

        $this->brandService->destroy($brand);
    }
}
