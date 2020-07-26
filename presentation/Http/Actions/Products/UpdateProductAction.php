<?php


namespace Presentation\Http\Actions\Products;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Adapters\Product\UpdateProductAdapter;
use Presentation\Http\Enums\HttpCodes;

class UpdateProductAction
{
    private UpdateProductAdapter $adapter;

    public function __construct(UpdateProductAdapter $adapter)
    {

    }

    public function __invoke(Request $request)
    {
        return new JsonResponse([
            'message' => 'Product created successfully',
        ], HttpCodes::CREATED);
    }
}
