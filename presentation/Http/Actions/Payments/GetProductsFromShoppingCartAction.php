<?php


namespace Presentation\Http\Actions\Payments;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Enums\HttpCodes;

class GetProductsFromShoppingCartAction
{
    public function __construct()
    {

    }

    public function __invoke(Request $request)
    {
        $products = $request->input('products');
        logger($products);
        $productsList = [];
        $id = 0;
        foreach ($products as $product) {
            array_push($productsList, [
                'id' => $id++,
                'name' => 'notebook lenovo',
                'price' => 1500,
                'images' => [
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTdmrVL1IU_101wa7aT39V5e2yiAkx0cn3lNw&usqp=CAU'
                ],
                'characteristics' => [
                    [
                        'name' => 'Color',
                        'value' => 'rojo'
                    ],
                ],
                'brands' => [
                    'Lenovo'
                ],
                'quantity' => $product['quantity'],
            ]);
        }

        return new JsonResponse([
            'data' => $productsList,
        ], HttpCodes::OK);

        // TODO: Implement __invoke() method.
    }
}
