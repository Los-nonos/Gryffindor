<?php


namespace Application\Services\Notification;


use Domain\Interfaces\Services\Notifications\NotifiableInterface;

interface InternalNotificationServiceInterface
{
    public function sendNotification(NotifiableInterface $data):void;
}
