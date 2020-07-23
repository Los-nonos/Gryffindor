<?php


namespace Application\Exceptions;


class CalculatedAmountInvalid extends ApplicationException
{
    public function __construct()
    {
        parent::__construct('The calculated quantity is not equal to the quantity provided', 400);
    }
}
