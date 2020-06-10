<?php


namespace Application\Exceptions;


use Presentation\Http\Enums\HttpCodes;

class PasswordNotMatch extends ApplicationException
{
    public function __construct()
    {
        parent::__construct("The password don't match", HttpCodes::BAD_REQUEST);
    }
}
