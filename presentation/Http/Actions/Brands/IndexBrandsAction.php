<?php


namespace Presentation\Http\Actions\Brands;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Brands\IndexBrandsAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Brands\IndexBrandsPresenter;

class IndexBrandsAction
{
    private IndexBrandsAdapter $adapter;

    private QueryBusInterface $queryBus;

    private IndexBrandsPresenter $presenter;

    public function __construct(
        IndexBrandsAdapter $adapter,
        QueryBusInterface $queryBus,
        IndexBrandsPresenter $presenter
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
