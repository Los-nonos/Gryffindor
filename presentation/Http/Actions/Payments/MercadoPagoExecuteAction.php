<?php


namespace Presentation\Http\Actions\Payments;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\CommandBus\CommandBusInterface;
use Presentation\Http\Adapters\Payments\MercadoPagoExecuteAdapter;
use Presentation\Http\Enums\HttpCodes;

class MercadoPagoExecuteAction
{
    private MercadoPagoExecuteAdapter $adapter;

    private CommandBusInterface $commandBus;

    public function __construct(
        MercadoPagoExecuteAdapter $adapter,
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

        return new JsonResponse([
            'message' => 'Payment successfully'
        ], HttpCodes::NO_CONTENT);
    }
}
