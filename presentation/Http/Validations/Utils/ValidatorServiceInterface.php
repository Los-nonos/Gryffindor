<?php

declare(strict_types=1);

namespace presentation\Http\Validations\Utils;

interface ValidatorServiceInterface
{
    public function make(array $options, array $rules);

    public function isValid();

    public function getErrors();

}
