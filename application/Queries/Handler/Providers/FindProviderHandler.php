<?php


namespace Application\Queries\Handler\Providers;


use Application\Queries\Query\Providers\FindProviderQuery;
use Application\Queries\Results\Providers\FindProviderResult;
use Domain\Interfaces\Services\Provider\ProviderServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindProviderHandler implements HandlerInterface
{
    private ProviderServiceInterface $providerService;

    public function __construct(ProviderServiceInterface $providerService)
    {
        $this->providerService = $providerService;
    }

    /**
     * @param FindProviderQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $provider = $this->providerService->findOneByIdOrFail($query->getId());

        return new FindProviderResult($provider);
    }
}
