<?php


namespace Presentation\Http\Adapters\Categories;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Categories\UpdateCategoryCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Categories\UpdateCategorySchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class UpdateCategoryAdapter
{
    private ValidatorServiceInterface $validatorService;

    private UpdateCategorySchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        UpdateCategorySchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new UpdateCategoryCommand(
            $request->route('id'),
            $request->input('name'),
        );
    }
}
