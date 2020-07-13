<?php


namespace Presentation\Http\Presenters\Payments;


use Application\Queries\Results\Payments\GetProductsFromShoppingCartResult;

class GetProductsFromShoppingCartPresenter
{
    private GetProductsFromShoppingCartResult $result;

    public function fromResult($result): GetProductsFromShoppingCartPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $products = $this->result->getProducts();

        $productsList = [];
        foreach ($products as $product) {
            array_push($productsList, [
                'id' => $product->product->getId(),
                'name' => $product->product->getTitle(),
                'price' => $product->product->getPrice(),
                'images' => $product->product->getImages(),
                'characteristics' => $product->product->getCharacteristics(),
                'brands' => $product->product->getBrands(),
                'quantity' => $product->quantity,
            ]);
        }

        return $productsList;
    }
}
