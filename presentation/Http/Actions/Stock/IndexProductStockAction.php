<?php


namespace Presentation\Http\Actions\Stock;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Stock\IndexProductStockAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Stock\IndexProductStockPresenter;

class IndexProductStockAction
{
    private IndexProductStockAdapter $adapter;

    private QueryBusInterface $queryBus;

    private IndexProductStockPresenter $presenter;

    public function __construct(
        IndexProductStockAdapter $adapter,
        QueryBusInterface $queryBus,
        IndexProductStockPresenter $presenter
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
            'items' => $this->presenter->fromResult($result)->getData()
        ], HttpCodes::OK);
    }
}
