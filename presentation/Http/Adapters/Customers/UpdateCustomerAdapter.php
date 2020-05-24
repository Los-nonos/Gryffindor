<?php


namespace Presentation\Http\Adapters\Customers;


use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Customers\UpdateCustomerSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class UpdateCustomerAdapter
{
    private ValidatorServiceInterface $validatorService;

    private UpdateCustomerSchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        UpdateCustomerSchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    public function from(Request $request)
    {

    }
}
