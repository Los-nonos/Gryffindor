<?php


namespace Application\Exceptions;


class RoleInvalid extends ApplicationException
{
    public function __construct(
        $message = "An attempt was made to enter a role that does not correspond to a predefined one",
        $code = 400
    )
    {
        parent::__construct($message, $code);
    }
}
