<?php


namespace Presentation\Http\Adapters\Stock;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Stock\IndexProductStockQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\PageSizeSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class IndexProductStockAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), PageSizeSchema::getRules());

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new IndexProductStockQuery(
            $request->query('page'),
            $request->query('size'),
            $request->query('minValue'),
        );
    }
}
