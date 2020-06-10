<?php


namespace Presentation\Http\Adapters\Categories;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Categories\DestroyCategoryCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Categories\DestroyCategorySchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class DestroyCategoryAdapter
{
    private ValidatorServiceInterface $validatorService;

    private DestroyCategorySchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        DestroyCategorySchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    /**
     * @param Request $request
     * @return DestroyCategoryCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make(['id' => $request->route('id') ], $this->schema->getRules());

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new DestroyCategoryCommand(
            $request->route('id')
        );
    }
}
