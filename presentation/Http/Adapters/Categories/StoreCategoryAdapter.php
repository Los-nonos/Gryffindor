<?php


namespace Presentation\Http\Adapters\Categories;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Categories\StoreCategoryCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Categories\StoreCategorySchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class StoreCategoryAdapter
{
    private ValidatorServiceInterface $validatorService;

    private StoreCategorySchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        StoreCategorySchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    /**
     * @param Request $request
     * @return StoreCategoryCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new StoreCategoryCommand(
            $request->input('name'),
            $request->input('filters')
        );
    }
}
