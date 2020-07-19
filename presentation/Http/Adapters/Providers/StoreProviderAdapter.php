<?php


namespace Presentation\Http\Adapters\Providers;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Providers\StoreProviderCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class StoreProviderAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), []);

        if(!$this->validatorService->isValid())
        {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new StoreProviderCommand(
            $request->input('name'),
            $request->input('businessName'),
            $request->input('phoneNumber'),
            $request->input('zipCode'),
            $request->input('address'),
            $request->input('observations'),
        );
    }
}
