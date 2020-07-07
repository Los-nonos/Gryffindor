<?php


namespace Presentation\Http\Actions\Customers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Customers\IndexCustomerAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Customers\IndexCustomerPresenter;

class IndexCustomerAction
{
    private IndexCustomerAdapter $adapter;

    private QueryBusInterface $queryBus;

    private IndexCustomerPresenter $presenter;

    public function __construct(
        IndexCustomerAdapter $adapter,
        QueryBusInterface $queryBus,
        IndexCustomerPresenter $presenter
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
