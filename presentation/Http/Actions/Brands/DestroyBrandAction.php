<?php


namespace Presentation\Http\Actions\Brands;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Enums\HttpCodes;

class DestroyBrandAction
{
    private DestroyBrandAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        DestroyBrandAdapter $adapter,
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

        return new JsonResponse([], HttpCodes::NO_CONTENT);
    }
}
