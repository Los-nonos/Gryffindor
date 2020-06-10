<?php


namespace Presentation\Http\Actions\Auth;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Exceptions\InvalidBodyException;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Auth\RenewTokenAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Auth\LoginPresenter;

class RenewTokenAction
{
    /**
     * @var QueryBusInterface
     */
    private QueryBusInterface $queryBus;

    /**
     * @var RenewTokenAdapter
     */
    private RenewTokenAdapter $adapter;

    private LoginPresenter $presenter;

    /**
     * RenewTokenAction constructor.
     * @param RenewTokenAdapter $adapter
     * @param QueryBusInterface $queryBus
     * @param LoginPresenter $presenter
     */
    public function __construct(
        RenewTokenAdapter $adapter,
        QueryBusInterface $queryBus,
        LoginPresenter $presenter
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
        $command = $this->adapter->from($request);

        $result = $this->queryBus->handle($command);

        return new JsonResponse(
            $this->presenter->fromResult($result)->getData(),
            HttpCodes::OK
        );
    }
}
