<?php


namespace Presentation\Http\Actions\Products;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Product\UpdateProductAdapter;
use Presentation\Http\Enums\HttpCodes;

class UpdateProductAction
{
    private UpdateProductAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        UpdateProductAdapter $adapter,
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
            'message' => 'Product updated successfully',
        ], HttpCodes::NO_CONTENT);
    }
}
