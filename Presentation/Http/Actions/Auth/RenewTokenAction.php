<?php


namespace Presentation\Http\Actions\Auth;


use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Exceptions\InvalidBodyException;
use Presentation\Http\Adapters\Auth\RenewTokenAdapter;
use Presentation\Http\Presenters\Auth\LoginPresenter;

class RenewTokenAction
{
    /**
     * @var CommandBusInterface
     */
    private CommandBusInterface $commandBus;

    /**
     * @var RenewTokenAdapter
     */
    private RenewTokenAdapter $adapter;

    private LoginPresenter $presenter;

    /**
     * RenewTokenAction constructor.
     * @param RenewTokenAdapter $adapter
     * @param CommandBusInterface $commandBus
     * @param LoginPresenter $presenter
     */
    public function __construct(
        RenewTokenAdapter $adapter,
        CommandBusInterface $commandBus,
        LoginPresenter $presenter
    )
    {
        $this->adapter = $adapter;
        $this->commandBus = $commandBus;
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

        $result = $this->commandBus->handle($command);

        return new JsonResponse(
            $this->presenter->fromResult($result)->toJWT(),
            200
        );
    }
}
