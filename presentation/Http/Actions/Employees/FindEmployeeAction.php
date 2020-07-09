<?php


namespace Presentation\Http\Actions\Employees;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Employees\FindEmployeeAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Employees\FindEmployeePresenter;

class FindEmployeeAction
{
    private FindEmployeeAdapter $adapter;

    private QueryBusInterface $queryBus;

    private FindEmployeePresenter $presenter;

    public function __construct(
        FindEmployeeAdapter $adapter,
        QueryBusInterface $queryBus,
        FindEmployeePresenter $presenter
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
