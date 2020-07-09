<?php

declare(strict_types=1);

namespace Presentation\Http\Validations\Utils;

use Illuminate\Validation\Factory;

class ValidatorService implements ValidatorServiceInterface
{

    private Factory $validatorFactory;
    private $validated;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function make(array $options, array $rules, array $messages = [])
    {
        $this->validated = $this->validatorFactory->make($options, $rules, $messages);

    }

    public function isValid()
    {
        return !$this->validated->fails();
    }

    public function getErrors()
    {
        return $this->validated->errors()->all();
    }

    public function getValidator(){
        return $this->validated;
    }
}
