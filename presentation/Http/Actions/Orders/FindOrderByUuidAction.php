<?php


namespace Presentation\Http\Actions\Orders;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Orders\FindOrderByUuidAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Orders\FullOrderPresenter;

class FindOrderByUuidAction
{
    private FindOrderByUuidAdapter $adapter;

    private QueryBusInterface $queryBus;

    private FullOrderPresenter $presenter;

    public function __construct(
        FindOrderByUuidAdapter $adapter,
        QueryBusInterface $queryBus,
        FullOrderPresenter $presenter
    )
    {
        $this->adapter = $adapter;
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

        return new JsonResponse([
            'data' => $this->presenter->fromResult($result)->getData()
        ], HttpCodes::OK);
    }
}
