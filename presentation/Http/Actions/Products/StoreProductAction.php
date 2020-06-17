<?php


namespace Presentation\Http\Actions\Products;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Product\StoreProductAdapter;
use Presentation\Http\Enums\HttpCodes;

class StoreProductAction
{

    private StoreProductAdapter $adapter;
    private CommandBusInterface $commandBus;

    public function __construct
    (
        StoreProductAdapter $storeProductAdapter,
        CommandBusInterface $commandBusInterface
    )
    {
        $this->adapter = $storeProductAdapter;
        $this->commandBus = $commandBusInterface;
    }

    public function __invoke(Request $request)
    {
        $command = $this->adapter->adapt($request);

        $this->commandBus->handle($command);

        return new JsonResponse(
            ['message' => 'Product has been created successfully'],
            HttpCodes::CREATED
        );
    }
}
