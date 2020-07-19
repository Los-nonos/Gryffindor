<?php


namespace Presentation\Http\Adapters\Providers;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\PageSizeSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class IndexProvidersAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), PageSizeSchema::getRules());

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new IndexProvidersQuery(
            $request->query('page'),
            $request->query('size'),
        );
    }
}
