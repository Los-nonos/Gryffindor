<?php

namespace Presentation\Http\Actions\Auth;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;
use Presentation\Http\Adapters\Auth\LoginAdapter;
use Presentation\Interfaces\LoginPresenterInterface;
use const Presentation\Http\Enums\HTTP_CODES;

class LoginAction
{

    private LoginAdapter $loginAdapter;
    private CommandBusInterface $commandBus;
    private LoginPresenterInterface $presenter;

    public function __construct(
        LoginAdapter $adapter,
        CommandBusInterface $commandBus,
        LoginPresenterInterface $presenter
        )
    {
        $this->loginAdapter = $adapter;
        $this->commandBus = $commandBus;
        $this->presenter = $presenter;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function execute(Request $request)
    {
        $loginCommand = $this->loginAdapter->adapt($request);

        $result = $this->commandBus->handle($loginCommand);

        return new JsonResponse(
            $this->presenter->fromResult($result)->getData(),
            HTTP_CODES['CREATED']
        );
    }
}
