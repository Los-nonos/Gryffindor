<?php


namespace Presentation\Http\Adapters\Orders;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Orders\IndexOrdersQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Orders\IndexOrdersSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class IndexOrdersAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(
        ValidatorServiceInterface $validatorService
    )
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request) {
        $this->validatorService->make($request->all(), IndexOrdersSchema::getFiltered());

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new IndexOrdersQuery(
            $request->query('page'),
            $request->query('size'),
            $request->query('userId'),
        );
    }
}
