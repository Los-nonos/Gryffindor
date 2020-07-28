<?php


namespace Presentation\Http\Presenters\Products;


use Application\Queries\Results\Products\ProductListResult;

class IndexProductsPresenter
{
    private ProductListResult $result;

    public function fromResult($result): IndexProductsPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $items = [];
        $products = $this->result->getProducts();
        foreach ($products as $product) {
            array_push($items, [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'description' => $product->getDescription(),
                'images' => $this->getImages($product->getCharacteristics()),
                'price' => [
                    'amount' => ($product->getPrice()->getAmount() / 100),
                    'currency' => $product->getPrice()->getCurrency()
                ],
                'taxes' => [
                    'amount' => ($product->getTaxes()->getAmount() / 100),
                    'currency' => $product->getPrice()->getCurrency()
                ],
                'characteristics' => $this->getCharacteristics($product->getCharacteristics()),
                'categories' => $this->getCategories($product->getCategories()),
                'brand' => $this->getBrands($product->getBrands()),
            ]);
        }

        return [
          'items' => $items,
          'pageCount' => $this->result->getTotalQuantity(),
          'totalItems' => count($items),
        ];
    }

    private function getCategories($categories):array {
        $categoriesList = [];

        if(!$categories) {
            return $categoriesList;
        }


        foreach ($categories as $category) {
            array_push($categoriesList, [
                'id' => $category->getId(),
                'name' => $category->getName(),
            ]);
        }

        return $categoriesList;
    }

    private function getCharacteristics($characteristics) {
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

    private function getImages($characteristics) {
        $imagesList = [];

        if(!$characteristics) {
            return $imagesList;
        }


        foreach ($characteristics as $characteristic) {
            if($characteristic->getName() === 'image') {
                array_push($imagesList, $characteristic->getProperty());
            }
        }

        return $imagesList;
    }

    private function getBrands($brands)
    {
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
