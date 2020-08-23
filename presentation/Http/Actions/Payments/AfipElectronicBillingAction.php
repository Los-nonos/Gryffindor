<?php


namespace Presentation\Http\Actions\Payments;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Payments\AfipElectronicBillingAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Payments\AfipElectronicBillingPresenter;

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
    /**
     * @var AfipElectronicBillingPresenter
     */
    private AfipElectronicBillingPresenter $presenter;

    public function __construct(
        AfipElectronicBillingAdapter $adapter,
        QueryBusInterface $queryBus,
        AfipElectronicBillingPresenter $presenter
    )
    {
        $this->adapter = $adapter;
        $this->queryBus = $queryBus;
        $this->presenter = $presenter;
    }

    public function __invoke(Request $request)
    {
        $query = $this->adapter->from($request);

        $result = $this->queryBus->handle($query);

        $presenter = $this->presenter->fromResult($result);

        return new JsonResponse(['data' => $presenter->getData(), 'voucher' => $presenter->createVoucherFile($result)], HttpCodes::CREATED);
    }
}
