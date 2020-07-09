<?php


namespace Application\Queries\Results\Orders;


use Infrastructure\QueryBus\Result\ResultInterface;

class IndexOrdersResult implements ResultInterface
{
    private $orders;

    public function setOrders($orders): void {
        $this->orders = $orders;
    }

    public function getOrders() {
        return $this->orders;
    }
}
