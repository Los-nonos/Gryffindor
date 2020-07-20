<?php


namespace Presentation\Http\Adapters\Providers;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Providers\UpdateProviderCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Providers\StoreProviderSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class UpdateProviderAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), StoreProviderSchema::getRules());

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new UpdateProviderCommand(
            $request->route('id'),
            $request->input('name'),
            $request->input('businessName'),
            $request->input('phoneNumber'),
            $request->input('zipCode'),
            $request->input('address'),
            $request->input('observations'),
        );
    }
}
