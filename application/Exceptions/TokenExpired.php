<?php


namespace Application\Exceptions;


class TokenExpired extends ApplicationException
{
    public function __construct()
    {
        parent::__construct('Token expired', 401);
    }
}
