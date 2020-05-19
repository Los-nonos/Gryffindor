<?php


namespace App\Exceptions;


use Presentation\Http\Enums\HttpCodes;
use Throwable;

class BasePresentationException extends \Exception
{
    private int $statusCode;

    public function __construct($message = "", $code = HttpCodes::INTERNAL_ERROR, Throwable $previous = null)
    {
        $this->statusCode = $code;
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function getResponseMessage() {
        return $this->message;
    }
}
