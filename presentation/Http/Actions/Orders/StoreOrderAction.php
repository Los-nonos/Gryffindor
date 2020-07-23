<?php


namespace Presentation\Http\Actions\Orders;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;

class StoreOrderAction
{
    /**
     * @var StoreOrderAdapter
     */
    private StoreOrderAdapter $adapter;

    /**
     * @var CommandBusInterface
     */
    private CommandBusInterface $commandBus;

    public function __construct(
        StoreOrderAdapter $adapter,
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

        return new JsonResponse(['message' => 'Order has been saved successfully']);
    }
}
