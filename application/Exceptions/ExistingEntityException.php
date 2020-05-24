<?php

declare(strict_types=1);

namespace Application\Exceptions;

use Presentation\Http\Enums\HttpCodes;
use Throwable;

class ExistingEntityException extends ApplicationException
{

    public function __construct($message)
    {
        parent::__construct($message, HttpCodes::UNPROCESSABLE_ENTITY);
    }

}
