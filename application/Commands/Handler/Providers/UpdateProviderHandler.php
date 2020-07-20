<?php


namespace Application\Commands\Handler\Providers;


use Application\Commands\Command\Providers\UpdateProviderCommand;
use Domain\Interfaces\Services\Provider\ProviderServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class UpdateProviderHandler implements HandlerInterface
{
    private ProviderServiceInterface $providerService;

    public function __construct(ProviderServiceInterface $providerService)
    {
        $this->providerService = $providerService;
    }

    /**
     * @param UpdateProviderCommand $command
     */
    public function handle($command): void
    {
        $provider = $this->providerService->findOneByIdOrFail($command->getId());

        $provider->setName($command->getName());
        $provider->setBusinessName($command->getBusinessName());
        $provider->setAddress($command->getAddress());
        $provider->setPhoneNumber($command->getPhoneNumber());
        $provider->setZipCode($command->getZipCode());
        $provider->setObservations($command->getObservations());

        $this->providerService->persist($provider);
    }
}
