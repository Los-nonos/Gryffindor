<?php


namespace Presentation\Http\Actions\Providers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Providers\StoreProviderAdapter;
use Presentation\Http\Enums\HttpCodes;

class StoreProviderAction
{
    private StoreProviderAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        StoreProviderAdapter $adapter,
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

        return new JsonResponse(['message' => 'Provider has been created successfully'], HttpCodes::CREATED);
    }
}
