<?php


namespace Presentation\Http\Actions\Orders;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexOrdersAction
{
    public function __invoke(Request $request)
    {
        return new JsonResponse([
            'data' => [
                [
                    'name' => 'azucar',
                    'price' => '20'
                ]
            ]
        ]);
    }
}
