<?php


namespace Application\Queries\Handler\Providers;


use Application\Queries\Query\Providers\IndexProvidersQuery;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexProvidersHandler implements HandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param IndexProvidersQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $provider = $this->providerService->findAllPaginated($query->getPage(), $query->getSize());
    }
}
