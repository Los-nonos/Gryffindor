<?php


namespace Presentation\Http\Adapters\Customers;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Customers\StoreCustomerCommand;
use DateTime;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class StoreCustomerAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(
        ValidatorServiceInterface $validatorService
    )
    {
        $this->validatorService = $validatorService;
    }

    /**
     * @param Request $request
     * @return StoreCustomerCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), []);

        if(!$this->validatorService->isValid())
        {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new StoreCustomerCommand(
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
