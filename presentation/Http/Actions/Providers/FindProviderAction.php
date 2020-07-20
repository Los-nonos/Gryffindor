<?php


namespace Presentation\Http\Actions\Providers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Providers\FindProviderAdapter;
use Presentation\Http\Enums\HttpCodes;

class FindProviderAction
{
    private FindProviderAdapter $adapter;

    private QueryBusInterface $queryBus;

    private FindProviderPresenter $presenter;

    public function __construct(
        FindProviderAdapter $adapter,
        QueryBusInterface $queryBus,
        FindProviderPresenter $presenter
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

        return new JsonResponse([
            'data' => $this->presenter->fromResult($result)->getData()
        ], HttpCodes::OK);
    }
}
