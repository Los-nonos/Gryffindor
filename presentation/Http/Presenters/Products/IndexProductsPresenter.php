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
               'price' => $product->getPrice(),
               'taxes' => $product->getTaxes(),
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
            array_push($characteristicsList, [
                'id' => $characteristic->getId(),
                'name' => $characteristic->getName(),
                'value' => $characteristic->getValue(),
            ]);
        }

        return $characteristicsList;
    }

    private function getBrands($brands)
    {
        $brandList = [];

        if (!$brands) {
            return $brandList;
        }

        foreach ($brands as $brand) {
            array_push($brandList, [
                'id' => $brand->getId(),
                'name' => $brand->getName(),
            ]);
        }

        return $brandList;
    }
}
