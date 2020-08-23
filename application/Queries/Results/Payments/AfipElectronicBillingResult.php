<?php


namespace Application\Queries\Results\Payments;


use Domain\Entities\Order;
use Infrastructure\QueryBus\Result\ResultInterface;

class AfipElectronicBillingResult implements ResultInterface
{
    /**
     * @var Order
     */
    private Order $order;
    private array $result;

    public function __construct(Order $order, array $result)
    {
        $this->order = $order;
        $this->result = $result;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }
}
