<?php


namespace Application\Exceptions;


use Throwable;

class ApplicationException extends \Exception
{
    public function __construct($message = "", $code = 500)
    {
        parent::__construct($message, $code);
    }
}
