<?php


namespace Presentation\Http\Actions\Products;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Products\IndexProductsHomePresenter;

class SearchProductsForHomeAction
{
    private IndexProductsHomePresenter $presenter;

    public function __construct(IndexProductsHomePresenter $presenter)
    {
        $this->presenter = $presenter;
    }

    public function __invoke(Request $request)
    {
        return new JsonResponse(
            $this->presenter->getData(),
            HttpCodes::OK
        );
    }
}
