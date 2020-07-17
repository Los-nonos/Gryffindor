<?php


namespace Presentation\Http\Actions\Filters;


use Application\Queries\Query\Categories\IndexCategoryQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Categories\IndexCategoryPresenter;

class IndexFiltersAction
{
    private QueryBusInterface $queryBus;

    private IndexCategoryPresenter $categoryPresenter;

    public function __construct(
        QueryBusInterface $queryBus,
        IndexCategoryPresenter $categoryPresenter
    )
    {
        $this->queryBus = $queryBus;
        $this->categoryPresenter = $categoryPresenter;
    }

    public function __invoke(Request $request)
    {
        $categoriesQuery = new IndexCategoryQuery(1, 100);

        $categoriesResult = $this->queryBus->handle($categoriesQuery);

        $categories = $this->categoryPresenter->fromResult($categoriesResult)->getData();

        return new JsonResponse([
            'data' => [
                'categories' => $categories,
                'brands' => [['id' => 1, 'name' => 'Asus']],
                'providers' => [['id' => 1, 'name' => 'El kiosquito de la esquina']]
            ]],
            HttpCodes::OK
        );
    }
}
