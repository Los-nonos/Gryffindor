<?php


namespace Presentation\Http\Adapters\Customers;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Customers\FindCustomerQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\IdSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class FindCustomerAdapter
{
    private ValidatorServiceInterface $validatorService;

    private IdSchema $idSchema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        IdSchema $idSchema
    )
    {
        $this->validatorService = $validatorService;
        $this->idSchema = $idSchema;
    }

    /**
     * @param Request $request
     * @return FindCustomerQuery
     * @throws InvalidBodyException
     */
    public function from(Request $request) {
        $this->validatorService->make([$request->route('id')], $this->idSchema->getRule());

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new FindCustomerQuery(
            $request->route('id'),
        );
    }
}
