<?php


namespace Presentation\Http\Actions\Filters;


use Application\Queries\Query\Brands\IndexBrandsQuery;
use Application\Queries\Query\Categories\IndexCategoryQuery;
use Application\Queries\Query\Providers\IndexProvidersQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Brands\IndexBrandsPresenter;
use Presentation\Http\Presenters\Categories\IndexCategoryPresenter;
use Presentation\Http\Presenters\Providers\IndexProvidersPresenter;

class IndexFiltersAction
{
    private QueryBusInterface $queryBus;

    private IndexCategoryPresenter $categoryPresenter;

    private IndexBrandsPresenter $brandsPresenter;

    private IndexProvidersPresenter $providersPresenter;

    public function __construct(
        QueryBusInterface $queryBus,
        IndexCategoryPresenter $categoryPresenter,
        IndexBrandsPresenter $brandsPresenter,
        IndexProvidersPresenter $providersPresenter
    )
    {
        $this->queryBus = $queryBus;
        $this->categoryPresenter = $categoryPresenter;
        $this->brandsPresenter = $brandsPresenter;
        $this->providersPresenter = $providersPresenter;
    }

    public function __invoke(Request $request)
    {
        $categoriesQuery = new IndexCategoryQuery(1, 100);

        $categoriesResult = $this->queryBus->handle($categoriesQuery);

        $categories = $this->categoryPresenter->fromResult($categoriesResult)->getData();

        $brandsQuery = new IndexBrandsQuery(1, 100);

        $brandsResult = $this->queryBus->handle($brandsQuery);

        $brands = $this->brandsPresenter->fromResult($brandsResult)->getData();

        $providersQuery = new IndexProvidersQuery(1, 100);

        $providersResult = $this->queryBus->handle($providersQuery);

        $providers = $this->providersPresenter->fromResult($providersResult)->getData();

        return new JsonResponse([
            'data' => [
                'categories' => $categories,
                'brands' => $brands,
                'providers' => $providers
            ]],
            HttpCodes::OK
        );
    }
}
