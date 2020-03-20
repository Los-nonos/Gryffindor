<?php

declare(strict_types=1);

namespace Presentation\Services;

use Presentation\Interfaces\ValidatorServiceInterface;
use Illuminate\Validation\Factory;

class ValidatorService implements ValidatorServiceInterface
{

    private $validatorFactory;
    private $validated;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function make(array $options, array $rules)
    {
        $this->validated = $this->validatorFactory->make($options, $rules);

    }

    public function isValid()
    {
        return !$this->validated->fails();
    }

    public function getErrors()
    {
        return $this->validated->errors();
    }

    public function getValidator(){
        return $this->validated;
    }
}
