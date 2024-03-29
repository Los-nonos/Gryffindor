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

        if(!$products) {
            return [];
        }
        $productsList = [];
        foreach ($products as $product) {
            array_push($productsList, [
                'id' => $product['product']->getId(),
                'name' => $product['product']->getTitle(),
                'price' => [
                    'amount' => ($product['product']->getPrice()->add($product['product']->getTaxes())->getAmount() / 100),
                    'currency' => $product['product']->getPrice()->getCurrency(),
                ],
                'taxes' => [
                    'amount' => $product['product']->getTaxes()->getAmount(),
                    'currency' => $product['product']->getTaxes()->getCurrency(),
                ],
                'images' => $this->clearImages($product['product']->getCharacteristics()),
                'characteristics' => $this->clearCharacteristics($product['product']->getCharacteristics()),
                'brands' => $this->clearBrand($product['product']->getBrands()),
                'quantity' => $product['quantity'],
            ]);
        }

        return $productsList;
    }

    public function clearCharacteristics($characteristics) {
        $characteristicsList = [];

        if(!$characteristics) {
            return $characteristicsList;
        }


        foreach ($characteristics as $characteristic) {
            if($characteristic->getName() !== 'image') {
                array_push($characteristicsList, [
                    'id' => $characteristic->getId(),
                    'name' => $characteristic->getName(),
                    'value' => $characteristic->getProperty(),
                ]);
            }
        }

        return $characteristicsList;
    }

    public function clearImages($characteristics) {
        $imageList = [];

        if(!$characteristics) {
            return $imageList;
        }


        foreach ($characteristics as $characteristic) {
            if($characteristic->getName() === 'image') {
                array_push($imageList, $characteristic->getProperty());
            }
        }

        return $imageList;
    }

    public function clearBrand($brands) {
        $brandList = [];

        if (!$brands) {
            return $brandList;
        }

        array_push($brandList, [
            'id' => $brands->getId(),
            'name' => $brands->getName(),
        ]);

        return $brandList;
    }
}
