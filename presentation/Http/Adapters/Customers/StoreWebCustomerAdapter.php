<?php


namespace Presentation\Http\Adapters\Customers;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Customers\StoreWebCustomerCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Customers\StoreWebCustomerSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class StoreWebCustomerAdapter
{
    private ValidatorServiceInterface $validatorService;

    private StoreWebCustomerSchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        StoreWebCustomerSchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    /**
     * @param Request $request
     * @return StoreWebCustomerCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        if(!$this->validatorService->isValid())
        {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new StoreWebCustomerCommand(
            $request->input('name'),
            $request->input('surname'),
            $request->input('username'),
            $request->input('email'),
            $request->input('password'),
        );
    }
}
