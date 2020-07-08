<?php


namespace Presentation\Http\Adapters\Orders;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Orders\FindOrderByUuidQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class FindOrderByUuidAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    /**
     * @param Request $request
     * @return FindOrderByUuidQuery
     * @throws InvalidBodyException
     */
    public function from(Request $request) {
        $this->validatorService->make([ 'uuid' => $request->route('uuid') ], [ 'uuid' => 'bail|required|alpha_dash']);

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new FindOrderByUuidQuery(
            $request->route('uuid')
        );
    }
}
