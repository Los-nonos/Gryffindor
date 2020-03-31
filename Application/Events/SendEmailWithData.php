<?php

namespace Application\Events;

use Illuminate\Queue\SerializesModels;
use Domain\ValueObjects\Email;

class SendEmailWithData
{
    use SerializesModels;

    public Email $data;

    public function __construct(Email $email)
    {
        $this->data = $email;
    }
}
