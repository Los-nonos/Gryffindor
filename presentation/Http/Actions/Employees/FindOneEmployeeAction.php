<?php


namespace Presentation\Http\Actions\Employees;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Employees\FindOneEmployeeAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Employee\FindOneEmployeePresenter;

class FindOneEmployeeAction
{
    private FindOneEmployeeAdapter $adapter;

    private QueryBusInterface $queryBus;

    private FindOneEmployeePresenter $presenter;

    public function __construct(
        FindOneEmployeeAdapter $adapter,
        QueryBusInterface $queryBus,
        FindOneEmployeePresenter $presenter
    )
    {
        $this->adapter = $adapter;
        $this->queryBus = $queryBus;
        $this->presenter = $presenter;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Exceptions\InvalidBodyException
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
