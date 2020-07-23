<?php


namespace Application\Exceptions;


class StockInvalidQuantity extends ApplicationException
{
    public function __construct()
    {
        parent::__construct('the stock cannot be equal to or less than 0', 400);
    }
}
