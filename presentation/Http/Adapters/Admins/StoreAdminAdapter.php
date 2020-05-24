<?php


namespace Presentation\Http\Adapters\Admins;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Admins\StoreAdminCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Admins\StoreAdminSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class StoreAdminAdapter
{
    private ValidatorServiceInterface $validatorService;

    private StoreAdminSchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        StoreAdminSchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    /**
     * @param Request $request
     * @return StoreAdminCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        if(!$this->validatorService->isValid())
        {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new StoreAdminCommand(
            $request->input('name'),
            $request->input('surname'),
            $request->input('username'),
            $request->input('email'),
            $request->input('password'),
            $request->input('role'),
        );
    }
}
