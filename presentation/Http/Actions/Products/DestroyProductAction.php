<?php


namespace Presentation\Http\Actions\Products;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Enums\HttpCodes;

class DestroyProductAction
{
    private DestroyProductAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        DestroyProductAdapter $adapter,
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
            'message' => 'Product deleted successfully',
        ], HttpCodes::CREATED);
    }
}
