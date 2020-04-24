<?php


namespace Application\Services\Notification;


use Application\Jobs\InternalNotificationJob;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Domain\Interfaces\Services\Notifications\NotificationInterface;

class InternalNotificationService implements InternalNotificationServiceInterface
{
    private NotificationInterface $notification;

    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    public function sendNotification(NotifiableInterface $data): void
    {
        InternalNotificationJob::dispatch($this->notification->internalNotification($data))->onQueue('notifications');
    }
}
