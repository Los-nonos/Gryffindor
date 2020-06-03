<?php


namespace Presentation\Http\Adapters\Customers;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Customers\UpdateCustomerCommand;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Customers\UpdateCustomerSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class UpdateCustomerAdapter
{
    private ValidatorServiceInterface $validatorService;

    private UpdateCustomerSchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        UpdateCustomerSchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    /**
     * @param Request $request
     * @return UpdateCustomerCommand
     * @throws InvalidBodyException
     * @throws Exception
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        if(!$this->validatorService->isValid())
        {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new UpdateCustomerCommand(
            $request->route('id'),
            $request->input('vat_condition'),
            new Datetime($request->input('birthday')),
            $request->input('country'),
            $request->input('state'),
            $request->input('city'),
            $request->input('postal_code'),
            $request->input('cell_phone'),
            $request->input('dni'),
            $request->input('taxation_key'),
            $request->input('gross_income')
        );
    }
}
