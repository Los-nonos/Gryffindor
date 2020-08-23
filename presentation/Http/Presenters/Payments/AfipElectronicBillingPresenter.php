<?php


namespace Presentation\Http\Presenters\Payments;


use Application\Queries\Results\Payments\AfipElectronicBillingResult;
use Domain\Entities\Product;

class AfipElectronicBillingPresenter
{
    private AfipElectronicBillingResult $result;

    public function fromResult($result): AfipElectronicBillingPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData()
    {
        $order = $this->result->getOrder();
        $result = $this->result->getResult();

        return [
            'id' => $order->getId(),
            'products' => $this->parseProducts($order->getProducts()),
            'customer' => $order->getCustomer()->getId(),
            'total' => $order->getAmount(),
            'cae' => $result['CAE'],
            'endDateCae' => $result[''],
        ];
    }

    public function createVoucher()
    {
        $file = null;

        return $file;
    }

    /**
     * @param Product[] $getProducts
     * @return array
     */
    private function parseProducts(array $getProducts)
    {
        $productList = [];

        foreach ($getProducts as $product) {
            array_push($productList, [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'price' => $product->getPrice(),
            ]);
        }

        return $productList;
    }
}
