<?php


namespace Presentation\Http\Actions\Users;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Users\ChangePasswordFromRecoveryAdapter;
use Presentation\Http\Enums\HttpCodes;

class ChangePasswordFromRecoveryAction
{
    private ChangePasswordFromRecoveryAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        ChangePasswordFromRecoveryAdapter $adapter,
        CommandBusInterface $commandBus
    )
    {
        $this->adapter = $adapter;
        $this->commandBus = $commandBus;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidBodyException
     */
    public function __invoke(Request $request)
    {
        $command = $this->adapter->from($request);

        $this->commandBus->handle($command);

        return new JsonResponse(
            [ 'message' => 'Password changed successfully' ],
            HttpCodes::ASYNC
        );
    }
}
