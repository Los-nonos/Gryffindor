<?php


namespace Presentation\Http\Actions\Categories;

use App\Exceptions\InvalidBodyException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Categories\StoreCategoryAdapter;
use Presentation\Http\Enums\HttpCodes;

class StoreCategoryAction
{
    private StoreCategoryAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        StoreCategoryAdapter $adapter,
        CommandBusInterface $commandBus
    )
    {
        $this->adapter = $adapter;
        $this->commandBus = $commandBus;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidBodyException
     */
    public function __invoke(Request $request)
    {
        $command = $this->adapter->from($request);

        $this->commandBus->handle($command);

        return new JsonResponse(
            ['message' => 'Category has been created successfully'],
            HttpCodes::OK
        );
    }
}
