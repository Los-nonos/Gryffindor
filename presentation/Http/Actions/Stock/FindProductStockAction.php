<?php


namespace Presentation\Http\Actions\Stock;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Stock\FindProductStockAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Stock\FindProductStockPresenter;

class FindProductStockAction
{
    private FindProductStockAdapter $adapter;

    private QueryBusInterface $queryBus;

    private FindProductStockPresenter $presenter;

    public function __construct(
        FindProductStockAdapter $adapter,
        QueryBusInterface $queryBus,
        FindProductStockPresenter $presenter
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
