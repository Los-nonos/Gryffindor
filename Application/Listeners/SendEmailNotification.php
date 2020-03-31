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

        //$subscriber->subscribe($this);
    }

    public function failed(SendEmailWithData $event, $exception)
    {

    }
}
