<?php


namespace Presentation\Http\Actions\Employees;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Enums\HttpCodes;

class StoreEmployeeAction
{
    public function __construct()
    {

    }

    public function __invoke(Request $request)
    {
        $command = $this->adapter->from($request);

        $this->commandBus->handle($command);

        return new JsonResponse(
            ['message' => 'Employee created successfully'],
            HttpCodes::CREATED
        );
    }
}
