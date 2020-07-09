<?php


namespace Presentation\Http\Adapters\Stock;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Stock\FindProductStockQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\IdSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class FindProductStockAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request)
    {
        $this->validatorService->make([ 'id' => $request->route('id') ], IdSchema::getRules());

        if(!$this->validatorService->isValid()){
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new FindProductStockQuery(
            $request->route('id')
        );
    }
}
