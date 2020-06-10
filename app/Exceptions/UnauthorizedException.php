<?php


namespace App\Exceptions;


use Presentation\Http\Enums\HttpCodes;

class UnauthorizedException extends BasePresentationException
{
    public function __construct(string $responseMessage)
    {
        parent::__construct($responseMessage, HttpCodes::UNAUTHORIZED);
    }
}
