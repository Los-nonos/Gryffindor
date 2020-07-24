<?php


namespace Presentation\Http\Adapters\Providers;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Providers\DestroyProviderCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\IdSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class DestroyProviderAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request)
    {
        $this->validatorService->make(['id' => $request->route('id')], IdSchema::getRules());

        if ($this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new DestroyProviderCommand($request->route('id'));
    }
}
