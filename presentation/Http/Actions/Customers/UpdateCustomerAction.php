<?php


namespace Presentation\Http\Actions\Customers;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Customers\UpdateCustomerAdapter;
use Presentation\Http\Enums\HttpCodes;

class UpdateCustomerAction
{
    private UpdateCustomerAdapter $adapter;
    private CommandBusInterface $commandBus;

    public function __construct(
        UpdateCustomerAdapter $adapter,
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
            ['message' => 'Customer has been updated successfully'],
            HttpCodes::OK
        );
    }
}
