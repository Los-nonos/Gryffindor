<?php


namespace Presentation\Http\Adapters\Orders;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Orders\IndexAllOrdersQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class IndexAllOrdersAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request) {
        $this->validatorService->make($request->all(), []);

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new IndexAllOrdersQuery(
            $request->query('page'),
            $request->query('size')
        );
    }
}
