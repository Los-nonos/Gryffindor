<?php


namespace Presentation\Http\Presenters\Orders;


use Application\Queries\Results\Orders\FindOrderByUuidResult;

class FullOrderPresenter
{
    private FindOrderByUuidResult $result;

    public function fromResult($result): FullOrderPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $order = $this->result->getOrder();
        return [
            'id' => $order->getId(),
            'products' => $this->getProducts($order->getProducts()),
            'amount' => $order->getAmount(),
            'numberSell' => $order->getNumberSell(),
        ];
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
