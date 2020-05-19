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
        $this->notificationData->setEmail(env('MAIL_FROM_ADDRESS'));
        $this->notificationData->setName(env('MAIL_FROM_NAME'));

        return $this->notificationData;
    }

    public function generateNotificationData(): NotifiableInterface
    {
        //Implementar funcionalidad
        return $this->notificationData;
    }
}
