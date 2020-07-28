<?php


namespace Presentation\Http\Presenters\Stock;


use Application\Queries\Results\Stock\IndexProductStockResult;

class IndexProductStockPresenter
{
    private IndexProductStockResult $result;

    public function fromResult($result): IndexProductStockPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $productsList = [];
        $products = $this->result->getProducts();
        foreach ($products as $product) {
            $stock = $product->getStock();
            array_push($productsList, [
                'id' => $stock->getId(),
                'product' => [
                    'id' => $product->getId(),
                    'title' => $product->getTitle(),
                    'brand' => $product->getBrands()->getName(),
                    'description' => $product->getDescription(),
                    'price' => [
                        'amount' => ($stock->getProduct()->getPrice()->add($stock->getProduct()->getTaxes())->getAmount() / 100),
                        'currency' => $stock->getProduct()->getPrice()->getCurrency(),
                    ],
                ],
                'quantity' => $stock->getQuantity(),
                'remanentQuantity' => $stock->getRemanentQuantity(),
            ]);
        }

        return $productsList;
    }
}
