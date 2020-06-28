<?php


namespace Presentation\Http\Presenters\Products;


class IndexProductsPresenter
{
    private $result;

    public function fromResult($result): IndexProductsPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $items = [
            [
                'name' => 'Notebook asus',
                'description' => 'notebook asus azul',
                'characteristics' => array(

                ),
                'price' => '900',
                'uuid' => 'uuid-number-one',
            ],
            [
                'name' => 'Notebook asus',
                'description' => 'notebook asus roja',
                'characteristics' => array(

                ),
                'price' => '900',
                'uuid' => 'uuid-number-two',
            ],
        ];

        return [
          'items' => $items,
          'pageCount' => 1,
          'totalItems' => count($items),
        ];
    }
}
