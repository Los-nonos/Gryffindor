<?php


namespace Presentation\Http\Adapters\Users;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Users\EnableUserCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\IdSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class EnableUserAdapter
{
    private ValidatorServiceInterface $validatorService;

    private IdSchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        IdSchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    /**
     * @param Request $request
     * @return EnableUserCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $id = $request->route('id');
        $this->validatorService->make(['id' => $id], $this->schema->getRule());

         if (!$this->validatorService->isValid()) {
             throw new InvalidBodyException($this->validatorService->getErrors());
         }

        return new EnableUserCommand(
            $request->route('id')
        );
    }
}
