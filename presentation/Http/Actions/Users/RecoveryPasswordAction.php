<?php


namespace Presentation\Http\Actions\Users;


use App\Exceptions\InvalidBodyException;
use Application\Exceptions\EntityNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Users\RecoveryPasswordAdapter;
use Presentation\Http\Enums\HttpCodes;

class RecoveryPasswordAction
{
    private RecoveryPasswordAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        RecoveryPasswordAdapter $adapter,
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
     * @throws EntityNotFoundException
     */
    public function __invoke(Request $request)
    {
        $command = $this->adapter->from($request);

        $this->commandBus->handle($command);

        return new JsonResponse([
                'message' => 'Email sent, check your email',
            ],
            HttpCodes::OK
        );
    }
}
