<?php


namespace Presentation\Http\Actions\Products;



use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindProductAction
{
    public function __construct()
    {

    }

    public function __invoke(Request $request)
    {
        if($request->route('uuid') == 'uuid-number-one') {
            return new JsonResponse(['data' => [
                'name' => 'Notebook asus',
                'description' => 'notebook asus azul',
                'characteristics' => array(

                ),
                'price' => '900',
                'uuid' => 'uuid-number-one',
                ]
            ]);
        }
        else if($request->route('uuid') == 'uuid-number-two') {
            return new JsonResponse(['data' => [
                    'name' => 'Notebook asus',
                    'description' => 'notebook asus roja',
                    'characteristics' => array(

                    ),
                    'price' => '900',
                    'uuid' => 'uuid-number-two',
                ],
            ]);
        }

        return new JsonResponse(['data' => [
            'name' => 'Notebook asus',
            'description' => 'notebook asus azul',
            'characteristics' => array(

            ),
            'price' => '900',
            'uuid' => 'uuid-number-one',
        ]
        ]);
    }
}
