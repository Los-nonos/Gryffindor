<?php


namespace Application\Services\Providers;


use Application\Exceptions\EntityNotFoundException;
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

    public function persist(Provider $provider) : void
    {
        $this->repository->persist($provider);
    }

    public function findOneByIdOrFail(int $id): Provider
    {
        $provider = $this->repository->findOneById($id);

        if(!$provider) {
            throw new EntityNotFoundException("Provider with id $id not found");
        }

        return $provider;
    }

    public function findAllPaginated($page, $size)
    {
        $page = $page ? $page : 1;
        $size = $size ? $size : 10;

        return $this->repository->findAllPaginated($page, $size);
    }

    public function destroy(Provider $provider)
    {
        $this->repository->destroy($provider);
    }
}
