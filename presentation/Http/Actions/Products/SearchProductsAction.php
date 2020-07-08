<?php


namespace Presentation\Http\Actions\Products;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Product\SearchProductsAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Products\IndexProductsPresenter;

class SearchProductsAction
{
    private SearchProductsAdapter $adapter;

    private QueryBusInterface $queryBus;

    private IndexProductsPresenter $presenter;

    public function __construct(
        SearchProductsAdapter $adapter,
        QueryBusInterface $queryBus,
        IndexProductsPresenter $presenter
    )
    {
        $this->queryBus = $queryBus;
        $this->presenter = $presenter;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidBodyException
     */
    public function __invoke(Request $request)
    {
        $query = $this->adapter->from($request);

        $result = $this->queryBus->handle($query);

        return new JsonResponse(
            $this->presenter->fromResult($result)->getData(),
            HttpCodes::OK
        );
    }
}
