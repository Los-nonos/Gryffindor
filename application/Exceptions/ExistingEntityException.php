<?php

declare(strict_types=1);

namespace Application\Exceptions;

use Throwable;

class ExistingEntityException extends \Exception
{

    public function __construct($message)
    {
        parent::__construct($message);
    }

}
