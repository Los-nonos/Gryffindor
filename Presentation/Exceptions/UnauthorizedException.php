<?php


namespace Presentation\Exceptions;



use const Presentation\Http\Enums\HTTP_CODES;

class UnauthorizedException extends BasePresentationException
{
    public function __construct(string $responseMessage)
    {
        parent::__construct($responseMessage, HTTP_CODES['UNAUTHORIZED']);
    }
}
