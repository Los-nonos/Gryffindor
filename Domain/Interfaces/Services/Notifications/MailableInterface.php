<?php


namespace Domain\Interfaces\Services\Notifications;


use Illuminate\Mail\Mailable;

interface MailableInterface
{
    public function emailNotification(NotificationInterface $notification) : Mailable;
}
