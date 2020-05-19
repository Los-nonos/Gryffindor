<?php


namespace App\Exceptions;


use Presentation\Http\Enums\HttpCodes;
use Throwable;

class Forbidden extends BasePresentationException
{
    public function __construct($message = "")
    {
        $message = ['message' => $message];

        parent::__construct($message, HttpCodes::FORBIDDEN);
    }
}
