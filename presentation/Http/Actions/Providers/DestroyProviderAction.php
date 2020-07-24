<?php


namespace Presentation\Http\Actions\Providers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Providers\DestroyProviderAdapter;
use Presentation\Http\Enums\HttpCodes;

class DestroyProviderAction
{
    private DestroyProviderAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        DestroyProviderAdapter $adapter,
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

        return new JsonResponse(['message' => 'Provider removed successfully'], HttpCodes::NO_CONTENT);
    }
}
