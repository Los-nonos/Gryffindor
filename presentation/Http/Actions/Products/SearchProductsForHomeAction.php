<?php


namespace Presentation\Http\Actions\Products;


use Application\Queries\Query\Products\SearchProductsQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Products\IndexProductsHomePresenter;

class SearchProductsForHomeAction
{
    private IndexProductsHomePresenter $presenter;

    private QueryBusInterface $queryBus;

    public function __construct(
        QueryBusInterface $queryBus,
        IndexProductsHomePresenter $presenter
    )
    {
        $this->queryBus = $queryBus;
        $this->presenter = $presenter;
    }

    public function __invoke(Request $request)
    {
        $query = new SearchProductsQuery(null, null,null,null,1,100, null);

        $result = $this->queryBus->handle($query);

        return new JsonResponse(
            $this->presenter->fromResult($result)->getData(),
            HttpCodes::OK
        );
    }
}
