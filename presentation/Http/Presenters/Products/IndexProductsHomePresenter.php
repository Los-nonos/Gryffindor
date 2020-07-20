<?php


namespace Presentation\Http\Presenters\Products;


use Application\Queries\Results\Products\ProductListResult;

class IndexProductsHomePresenter
{
    private ProductListResult $result;

    public function fromResult($result): IndexProductsHomePresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $items = $this->result->getProducts();

        return [
            'products' => $this->getFeaturedProducts(),
            'selledProducts' => $this->getFeaturedProducts(),
            'featuredProducts' => $this->getFeaturedProducts(),
            'pageCount' => 1,
            'totalItems' => count($items),
        ];
    }

    public function getFeaturedProducts(){
        $items = $this->result->getProducts();
        $itemList = [];
        $itemCount = count($items);

        for ($i = 0; $i < 3; $i++)
        {
            $item = random_int(0, $itemCount);
            $product = $items[$item];
            array_push($itemList, [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                //'image' => $product->getImage(), // TODO: add line when added image service
                'description' => $product->getDescription(),
            ]);
        }

        return $itemList;
    }
}
