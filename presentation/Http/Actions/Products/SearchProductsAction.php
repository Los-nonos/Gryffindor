<?php


namespace Presentation\Http\Actions\Products;


use Illuminate\Http\JsonResponse;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Products\IndexProductsPresenter;

class SearchProductsAction
{
    private IndexProductsPresenter $presenter;

    public function __construct(IndexProductsPresenter $presenter)
    {
        $this->presenter = $presenter;
    }

    public function __invoke()
    {
        return new JsonResponse(
            $this->presenter->getData(),
            HttpCodes::OK
        );
    }
}
