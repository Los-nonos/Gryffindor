<?php


namespace Domain\Interfaces\Services\Notifications;


use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

interface NotificationInterface
{
    public function emailNotification(NotifiableInterface $notifiable): Mailable;
    public function internalNotification(NotifiableInterface $notifiable):Notification;
}
