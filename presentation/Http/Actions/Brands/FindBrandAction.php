<?php


namespace Presentation\Http\Actions\Brands;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Brands\FindBrandAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Brands\FindBrandPresenter;

class FindBrandAction
{
    private FindBrandAdapter $adapter;

    private QueryBusInterface $queryBus;

    private FindBrandPresenter $presenter;

    public function __construct(
        FindBrandAdapter $adapter,
        QueryBusInterface $queryBus,
        FindBrandPresenter $presenter
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
