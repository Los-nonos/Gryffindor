<?php


namespace Presentation\Http\Adapters\Employees;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Employees\FindEmployeeQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class FindEmployeeAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    /**
     * @param Request $request
     * @return FindEmployeeQuery
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), []);

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new FindEmployeeQuery($request->query('page'), $request->query('size'));
    }
}
