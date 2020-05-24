<?php


namespace Application\Exceptions;


use Presentation\Http\Enums\HttpCodes;

class RoleInvalid extends ApplicationException
{
    public function __construct(
        $message = "An attempt was made to enter a role that does not correspond to a predefined one"
    )
    {
        parent::__construct($message, HttpCodes::BAD_REQUEST);
    }
}
