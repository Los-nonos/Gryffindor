<?php


namespace Presentation\Http\Adapters\Employees;


use Application\Commands\Command\Employees\StoreEmployeeCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Users\StoreEmployeeSchema;
use presentation\Http\Validations\Utils\ValidatorServiceInterface;

class StoreEmployeeAdapter
{
    private ValidatorServiceInterface $validatorService;

    private StoreEmployeeSchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        StoreEmployeeSchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        return new StoreEmployeeCommand(
            $request->input('name'),
            $request->input('surname'),
            $request->input('role'),
            $request->input('username'),
            $request->input('password'),
            $request->input('email'),
        );
    }
}
