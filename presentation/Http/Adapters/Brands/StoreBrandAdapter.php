<?php


namespace Presentation\Http\Adapters\Brands;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Brands\StoreBrandCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Brands\StoreBrandSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class StoreBrandAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), StoreBrandSchema::getRules());

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new StoreBrandCommand($request->input('name'), $request->input('description'));
    }
}
