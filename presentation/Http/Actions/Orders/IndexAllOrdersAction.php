<?php


namespace Presentation\Http\Actions\Orders;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Orders\IndexAllOrdersAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Orders\IndexOrdersPresenter;

class IndexAllOrdersAction
{
    private IndexAllOrdersAdapter $adapter;

    private QueryBusInterface $queryBus;

    private IndexOrdersPresenter $presenter;

    public function __construct(
        IndexAllOrdersAdapter $adapter,
        QueryBusInterface $queryBus,
        IndexOrdersPresenter $presenter
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
            'data' => $this->presenter->fromResult($result)->getData(),
        ], HttpCodes::OK);
    }
}
