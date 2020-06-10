<?php


namespace Presentation\Http\Actions\Categories;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Categories\DestroyCategoryAdapter;
use Presentation\Http\Enums\HttpCodes;

class DestroyCategoryAction
{
    private DestroyCategoryAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        DestroyCategoryAdapter $adapter,
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

        return new JsonResponse(
            ['message' => 'Category has been destroyed successfully'],
            HttpCodes::NO_CONTENT
        );
    }
}
