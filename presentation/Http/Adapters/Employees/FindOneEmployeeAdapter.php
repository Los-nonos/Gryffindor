<?php


namespace Presentation\Http\Adapters\Employees;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Employees\FindOneEmployeeQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\IdSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class FindOneEmployeeAdapter
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
     * @return FindOneEmployeeQuery
     * @throws InvalidBodyException
     */
    public function from(Request $request) {
        $this->validatorService->make([$request->route('id')], $this->idSchema->getRule());

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new FindOneEmployeeQuery(
            $request->route('id'),
        );
    }
}
