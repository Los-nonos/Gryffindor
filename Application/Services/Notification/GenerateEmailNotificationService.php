<?php


namespace Application\Services\Notification;


use Domain\Interfaces\Services\Notifications\NotificationInterface;

class GenerateEmailNotificationService
{
    private NotificationInterface $notificationData;

    public function __construct(NotificationInterface $notification)
    {
        $this->notificationData = $notification;
    }

    public function generate(): NotificationInterface
    {
        $this->notificationData->setEmail(env('MAIL_FROM_ADDRESS'));
        $this->notificationData->setName(env('MAIL_FROM_NAME'));

        return $this->notificationData;
    }
}
