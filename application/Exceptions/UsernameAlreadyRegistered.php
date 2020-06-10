<?php


namespace Application\Exceptions;


use Presentation\Http\Enums\HttpCodes;

class UsernameAlreadyRegistered extends ApplicationException
{

    /**
     * UsernameAlreadyRegistered constructor.
     * @param string $message
     */
    public function __construct($message = "the username is already registered")
    {
        parent::__construct($message, HttpCodes::BAD_REQUEST);
    }
}
