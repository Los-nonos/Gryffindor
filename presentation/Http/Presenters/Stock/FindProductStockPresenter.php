<?php


namespace Presentation\Http\Presenters\Stock;


use Application\Queries\Results\Stock\FindProductStockResult;

class FindProductStockPresenter
{
    private FindProductStockResult $result;

    public function fromResult($result): FindProductStockPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $stock = $this->result->getStock();

        return [
            'id' => $stock->getId(),
            'product' => [
                'id' => $stock->getProduct()->getId(),
                'title' => $stock->getProduct()->getTitle(),
                'brand' => $stock->getProduct()->getBrands()[0]->getName(),
            ],
            'quantity' => $stock->getQuantity(),
            'remanentQuantity' => $stock->getRemanentQuantity(),
        ];
    }
}
