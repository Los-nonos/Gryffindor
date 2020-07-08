<?php


namespace Application\Queries\Results\Orders;


use Domain\Entities\Order;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindOrderByUuidResult implements ResultInterface
{
    private Order $order;

    public function setOrder($order) {
        $this->order = $order;
    }

    public function getOrder() {
        return $this->order;
    }
}
