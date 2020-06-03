<?php


namespace Application\Exceptions;


use Presentation\Http\Enums\HttpCodes;

class EmailAlreadyRegistered extends ApplicationException
{
    public function __construct($message = "the email is already registered")
    {
        parent::__construct($message, HttpCodes::BAD_REQUEST);
    }
}
