<?php


namespace Application\Services\Notification;


use Domain\Interfaces\Services\Notifications\NotifiableInterface;

class GenerateEmailNotificationService
{
    private NotifiableInterface $notificationData;

    public function __construct(NotifiableInterface $notification)
    {
        $this->notificationData = $notification;
    }

    public function generate(): NotifiableInterface
    {
        $this->notificationData->setEmail(env('MAIL_FROM_ADDRESS'));
        $this->notificationData->setName(env('MAIL_FROM_NAME'));

        return $this->notificationData;
    }
}
