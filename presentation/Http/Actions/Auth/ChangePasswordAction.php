<?php


namespace Presentation\Http\Actions\Auth;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Auth\ChangePasswordAdapter;
use Presentation\Http\Enums\HttpCodes;

class ChangePasswordAction
{


    /**
     * @var ChangePasswordAdapter
     */
    private ChangePasswordAdapter $adapter;
    /**
     * @var CommandBusInterface
     */
    private CommandBusInterface $commandBus;

    public function __construct(
        ChangePasswordAdapter $adapter,
        CommandBusInterface $commandBus
    )
    {
        $this->adapter = $adapter;
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request)
    {
        $command = $this->adapter->from($request);

        $this->commandBus->handle($command);

        return new JsonResponse([
            'message' => 'Password changed successfully',
        ], HttpCodes::NO_CONTENT);
    }
}
