<?php


namespace Presentation\Http\Adapters\Orders;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Orders\StoreOrderCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class StoreOrderAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), []);

        if($this->validatorService->isValid()){
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new StoreOrderCommand(
            $request->input('amount'),
            $request->input('customerId'),
            $request->input('employeeId'),
            $request->input('products'),
        );
    }
}
