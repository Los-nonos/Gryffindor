<?php


namespace Presentation\Http\Actions\Products;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Enums\HttpCodes;

class UpdateProductAction
{
    public function __construct()
    {

    }

    public function __invoke(Request $request)
    {
        return new JsonResponse([
            'message' => 'Product created successfully',
        ], HttpCodes::CREATED);
    }
}
