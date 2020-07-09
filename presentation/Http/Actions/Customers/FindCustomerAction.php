<?php


namespace Presentation\Http\Actions\Customers;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Customers\FindCustomerAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Customers\FindCustomerPresenter;

class FindCustomerAction
{
    private FindCustomerAdapter $adapter;

    private QueryBusInterface $queryBus;

    private FindCustomerPresenter $presenter;

    public function __construct(
        FindCustomerAdapter $adapter,
        QueryBusInterface $queryBus,
        FindCustomerPresenter $presenter
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
            'data' => $this->presenter->fromResult($result)->getData(),
        ], HttpCodes::OK);
    }
}
