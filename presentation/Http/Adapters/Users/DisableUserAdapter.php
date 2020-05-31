<?php


namespace Presentation\Http\Adapters\Users;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Users\DisableUserCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\IdSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class DisableUserAdapter
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
     * @return DisableUserCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $id = $request->route('id');
        $this->validatorService->make(['id' => $id], $this->schema->getRule());

        if(!$this->validatorService->isValid())
        {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new DisableUserCommand(
            $request->route('id')
        );
    }
}
