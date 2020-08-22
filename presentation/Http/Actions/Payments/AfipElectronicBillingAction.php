<?php


namespace Presentation\Http\Actions\Payments;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Enums\HttpCodes;

class AfipElectronicBillingAction
{
    /**
     * @var AfipElectronicBillingAdapter
     */
    private AfipElectronicBillingAdapter $adapter;

    /**
     * @var QueryBusInterface
     */
    private QueryBusInterface $queryBus;

    public function __construct(
        AfipElectronicBillingAdapter $adapter,
        QueryBusInterface $queryBus
    )
    {
        $this->adapter = $adapter;
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request)
    {
        $query = $this->adapter->from($request);

        $result = $this->queryBus->handle($query);

        return new JsonResponse(['data' => ''], HttpCodes::CREATED);
    }
}
