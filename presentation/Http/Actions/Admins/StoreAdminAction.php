<?php


namespace Presentation\Http\Actions\Admins;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Admins\StoreAdminAdapter;
use Presentation\Http\Enums\HttpCodes;

class StoreAdminAction
{
    private StoreAdminAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        StoreAdminAdapter $adapter,
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
            ['message' => 'Admin has been created successfully'],
            HttpCodes::CREATED
        );
    }
}
