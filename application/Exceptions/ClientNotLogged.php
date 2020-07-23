<?php


namespace Application\Exceptions;


class ClientNotLogged extends ApplicationException
{
    public function __construct()
    {
        parent::__construct('Client for api not logged or have error', 500);
    }
}
