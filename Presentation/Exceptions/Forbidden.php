<?php


namespace Presentation\Exceptions;


use Throwable;

class Forbidden extends BasePresentationException
{
    public function __construct($message = "")
    {
        $message = ['message' => $message];

        parent::__construct($message, 403);
    }
}
