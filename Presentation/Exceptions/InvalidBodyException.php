<?php

declare(strict_types=1);

namespace Presentation\Exceptions;

use const Presentation\Http\Enums\HTTP_CODES;

class InvalidBodyException extends \Exception
{
    private $statusCode;
    private $responseMessage;

    public function __construct($responseMessage)
    {
        $this->statusCode = HTTP_CODES['UNPROCESSABLE_ENTITY'];
        $this->responseMessage = $responseMessage;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getResponseMessage()
    {
        return $this->responseMessage;
    }

}
