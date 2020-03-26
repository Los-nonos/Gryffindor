<?php


namespace Application\Exceptions;


class PasswordNotMatch extends \Exception
{
    public function __construct()
    {
        parent::__construct("The password don't match");
    }
}
