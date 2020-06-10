<?php


namespace Presentation\Http\Actions\Categories;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Categories\IndexCategoryAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Categories\IndexCategoryPresenter;

class IndexCategoryAction
{
    private IndexCategoryAdapter $adapter;

    private QueryBusInterface $queryBus;

    private IndexCategoryPresenter $presenter;

    public function __construct(
        IndexCategoryAdapter $adapter,
        QueryBusInterface $queryBus,
        IndexCategoryPresenter $presenter
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

        return new JsonResponse(
            [ 'data' => $this->presenter->fromResult($result)->getData() ],
            HttpCodes::OK
        );
    }
}
