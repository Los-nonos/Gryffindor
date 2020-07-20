<?php


namespace Application\Queries\Handler\Providers;


use Application\Queries\Query\Providers\IndexProvidersQuery;
use Application\Queries\Results\Providers\IndexProvidersResult;
use Domain\Interfaces\Services\Provider\ProviderServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexProvidersHandler implements HandlerInterface
{
    private ProviderServiceInterface $providerService;

    public function __construct(ProviderServiceInterface $providerService)
    {
        $this->providerService = $providerService;
    }

    /**
     * @param IndexProvidersQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $provider = $this->providerService->findAllPaginated($query->getPage(), $query->getSize());

        return new IndexProvidersResult($provider);
    }
}
