<?php


namespace Application\Commands\Handler\Providers;


use Application\Commands\Command\Providers\DestroyProviderCommand;
use Domain\Interfaces\Services\Provider\ProviderServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class DestroyProviderHandler implements HandlerInterface
{
    private ProviderServiceInterface $providerService;

    public function __construct(ProviderServiceInterface $providerService)
    {
        $this->providerService = $providerService;
    }

    /**
     * @param DestroyProviderCommand $command
     */
    public function handle($command): void
    {
        $provider = $this->providerService->findOneByIdOrFail($command->getId());

        $this->providerService->destroy($provider);
    }
}
