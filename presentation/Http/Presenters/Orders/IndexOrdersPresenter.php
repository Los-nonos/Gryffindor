<?php


namespace Presentation\Http\Presenters\Orders;


use Application\Queries\Results\Orders\IndexOrdersResult;

class IndexOrdersPresenter
{
    private IndexOrdersResult $result;

    public function fromResult($result): IndexOrdersPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $ordersList = [];
        $orders = $this->result->getOrders();

        foreach ($orders as $order) {
            array_push($ordersList, [
                'id' => $order->getId(),
                'products' => $this->getProducts($order->getProducts()),
                'amount' => $order->getAmount(),
                'numberSell' => $order->getNumberSell(),
            ]);
        }

        return $ordersList;
    }

    private function getProducts($products) {
        $productsList = [];

        foreach ($products as $product) {
            array_push($productsList, [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'price' => $product->getPrice(),
            ]);
        }

        return $productsList;
    }
}
