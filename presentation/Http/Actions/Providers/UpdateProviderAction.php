<?php


namespace Presentation\Http\Actions\Providers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Providers\UpdateProviderAdapter;
use Presentation\Http\Enums\HttpCodes;

class UpdateProviderAction
{
    private UpdateProviderAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        UpdateProviderAdapter $adapter,
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
            'message' => 'Provider updated successfully',
        ], HttpCodes::OK);
    }
}
