<?php


namespace Application\Services\Notification;


use Domain\Interfaces\Services\Notifications\NotifiableInterface;

class GenerateNotificationService
{
    private NotifiableInterface $notificationData;

    public function __construct(NotifiableInterface $notifiable)
    {
        $this->notificationData = $notifiable;
    }

    public function generateEmailData(): NotifiableInterface
    {
        $this->notificationData->setEmailFrom(env('MAIL_FROM_ADDRESS', "zeeporganization@gmail.com"));
        $this->notificationData->setNameFrom(env('MAIL_FROM_NAME', "Zeep Organization"));

        return $this->notificationData;
    }

    public function generateNotificationData(): NotifiableInterface
    {
        return $this->generateEmailData();
    }
}
