<?php


namespace Presentation\Http\Actions\Products;



use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Product\FindProductAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Products\FindProductPresenter;

class FindProductAction
{
    private FindProductAdapter $adapter;

    private QueryBusInterface $queryBus;

    private FindProductPresenter $presenter;

    public function __construct(
        FindProductAdapter $adapter,
        QueryBusInterface $queryBus,
        FindProductPresenter $presenter
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
