<?php


namespace Presentation\Http\Adapters\Categories;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Categories\IndexCategoryQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Categories\IndexCategorySchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class IndexCategoryAdapter
{
    private ValidatorServiceInterface $validatorService;

    private IndexCategorySchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        IndexCategorySchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    /**
     * @param Request $request
     * @return IndexCategoryQuery
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new IndexCategoryQuery(
            $request->query('page'),
            $request->query('size')
        );
    }
}
