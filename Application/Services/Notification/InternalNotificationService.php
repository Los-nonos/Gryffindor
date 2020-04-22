<?php


namespace Application\Services\Notification;


use Application\Jobs\InternalNotificationJob;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;

class InternalNotificationService implements InternalNotificationServiceInterface
{
    public function sendNotification(NotifiableInterface $data): void
    {
        // TODO: Implement sendNotification() method.

    }
}
