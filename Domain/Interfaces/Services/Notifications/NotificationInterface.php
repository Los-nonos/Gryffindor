<?php


namespace Domain\Interfaces\Services\Notifications;


use Illuminate\Notifications\Notification;

interface NotificationInterface
{
    public function internalNotification(NotifiableInterface $data):Notification;
}
