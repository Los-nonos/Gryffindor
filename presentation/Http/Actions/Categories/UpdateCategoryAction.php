<?php


namespace Presentation\Http\Actions\Categories;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Categories\UpdateCategoryAdapter;
use Presentation\Http\Enums\HttpCodes;

class UpdateCategoryAction
{
    private UpdateCategoryAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        UpdateCategoryAdapter $adapter,
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
            ['message' => 'Category has been updated successfully'],
            HttpCodes::OK
        );
    }
}
