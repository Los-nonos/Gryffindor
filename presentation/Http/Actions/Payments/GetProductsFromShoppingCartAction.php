<?php


namespace Presentation\Http\Actions\Payments;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Payments\GetProductsFromShoppingCartAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Payments\GetProductsFromShoppingCartPresenter;

class GetProductsFromShoppingCartAction
{
    private GetProductsFromShoppingCartAdapter $adapter;

    private QueryBusInterface $queryBus;

    private GetProductsFromShoppingCartPresenter $presenter;

    public function __construct(
        GetProductsFromShoppingCartAdapter $adapter,
        QueryBusInterface $queryBus,
        GetProductsFromShoppingCartPresenter $presenter
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
