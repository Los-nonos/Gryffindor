<?php


namespace Application\Exceptions;


class ClientNotInitialized extends ApplicationException
{
    public function __construct()
    {
        parent::__construct('Error, client for payments isn\'t logged', 500);
    }
}
