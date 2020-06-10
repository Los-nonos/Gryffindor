<?php


namespace Application\Exceptions;


use Presentation\Http\Enums\HttpCodes;

class InactiveUser extends ApplicationException
{
    public function __construct($message = "Your user is inactive")
    {
        parent::__construct($message, HttpCodes::UNAUTHORIZED);
    }
}
