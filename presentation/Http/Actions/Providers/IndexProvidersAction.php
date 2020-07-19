<?php


namespace Presentation\Http\Actions\Providers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Enums\HttpCodes;

class IndexProvidersAction
{
    private IndexProvidersAdapter $adapter;

    private QueryBusInterface $queryBus;

    private IndexProvidersPresenter $presenter;

    public function __construct(
        IndexProvidersAdapter $adapter,
        QueryBusInterface $queryBus,
        IndexProvidersPresenter $presenter
    )
    {
        $this->adapter = $adapter;
        $this->queryBus = $queryBus;
        $this->presenter = $presenter;
    }

    public function __invoke(Request $request)
    {
        $query = $this->adapter->from($request);

        $result = $this->queryBus->handle($query);

        return new JsonResponse(['data' => $this->presenter->fromResult($result)->getData() ], HttpCodes::OK);
    }
}
