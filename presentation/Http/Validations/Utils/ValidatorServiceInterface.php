<?php

declare(strict_types=1);

namespace Presentation\Http\Validations\Utils;

interface ValidatorServiceInterface
{
    public function make(array $options, array $rules);

    public function isValid();

    public function getErrors();

}
