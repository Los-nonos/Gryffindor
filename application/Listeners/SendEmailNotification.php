<?php

namespace Application\Listeners;

use Application\Events\SendEmailWithData;

class SendEmailNotification
{
    public function __construct()
    {

    }

    public function handle(SendEmailWithData $event)
    {

    }

    public function subscribe($subscriber)
    {
        $subscriber->listen(
            'Application\Events\SendEmailWithData',
            'Application\Listeners\SendEmailNotification@handle'
        );
    }

    public function failed(SendEmailWithData $event, $exception)
    {

    }
}
