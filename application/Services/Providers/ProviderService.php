<?php


namespace Application\Services\Providers;


use Domain\Entities\Provider;
use Domain\Interfaces\Repositories\ProviderRepositoryInterface;
use Domain\Interfaces\Services\Provider\ProviderServiceInterface;

class ProviderService implements ProviderServiceInterface
{
    private ProviderRepositoryInterface $repository;

    public function __construct
    (
        ProviderRepositoryInterface $providerRepository
    )
    {
        $this->repository = $providerRepository;
    }

    public function persis(Provider $provider) : void
    {
        $this->repository->persist($provider);
    }

    //TODO Terminar ProviderService
}
