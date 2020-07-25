<?php


namespace Presentation\Http\Adapters\Product;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Products\SearchProductsQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Products\SearchProductsSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class SearchProductsAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    /**
     * @param Request $request
     * @return SearchProductsQuery
     * @throws InvalidBodyException
     */
    public function from(Request $request) {
        $this->validatorService->make($request->all(), SearchProductsSchema::getRules(), []);

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new SearchProductsQuery(
            $request->query('query'),
            $request->query('categories'),
            $request->query('brands'),
            $request->query('providers'),
            $request->query('page'),
            $request->query('size'),
            $request->query('orderBy'),
            $request->query('minPrice'),
            $request->query('maxPrice')
        );
    }

}
