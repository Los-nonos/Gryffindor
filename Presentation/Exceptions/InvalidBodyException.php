<?php

declare(strict_types=1);

namespace Presentation\Exceptions;

use const Presentation\Http\Enums\HTTP_CODES;

class InvalidBodyException extends BasePresentationException
{
    private array $messages;

    /**
     * InvalidBodyException constructor.
     * @param $responseMessage
     */
    public function __construct($responseMessage = ""|[])
    {
        if(is_array($responseMessage))
        {
            $this->messages = $responseMessage;
            $responseMessage = json_encode($responseMessage);
        }

        parent::__construct($responseMessage, HTTP_CODES['UNPROCESSABLE_ENTITY']);
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}
