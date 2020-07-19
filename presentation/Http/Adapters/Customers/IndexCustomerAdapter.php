<?php


namespace Presentation\Http\Adapters\Customers;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Customers\IndexCustomerQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\PageSizeSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class IndexCustomerAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(
        ValidatorServiceInterface $validatorService
    )
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), PageSizeSchema::getRules());

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new IndexCustomerQuery(
            $request->query('page'),
            $request->query('size'),
            $request->query('name'),
            $request->query('dni'),
            $request->query('cuil'),
        );
    }
}
