<?php


namespace Presentation\Http\Actions\Auth;


use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Exceptions\InvalidBodyException;
use Presentation\Http\Adapters\Auth\LoginAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Auth\LoginPresenter;

class LoginAction
{
    private LoginAdapter $adapter;

    private CommandBusInterface $commandBus;

    private LoginPresenter $presenter;

    public function __construct(
        LoginAdapter $adapter,
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
            HttpCodes::OK
        );
    }
}
