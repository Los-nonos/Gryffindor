<?php


namespace Application\Services\Notification;

use Application\Jobs\EmailNotificationJob;
use Application\Jobs\InternalNotificationJob;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;

class NotifiableService implements NotifiableServiceInterface
{
    private GenerateNotificationService $generateNotificationService;
    private NotifiableInterface $notification;

    public function __construct(
        GenerateNotificationService $generateNotificationService,
        NotifiableInterface $notification)
    {
        $this->generateNotificationService = $generateNotificationService;
        $this->notification = $notification;
    }

    public function notificationEmailData(): NotifiableInterface
    {
        return $this->generateNotificationService->generateEmailData();
    }

    public function sendEmail(NotifiableInterface $data): void
    {
        EmailNotificationJob::dispatch($this->notification->emailNotification($data))->onQueue('emails');
    }

    public function notificationNotificationData(): NotifiableInterface
    {
        return $this->generateNotificationService->generateNotificationData();
    }

    public function sendNotification(NotifiableInterface $data): void
    {
        InternalNotificationJob::dispatch($this->notification->internalNotification($data))->onQueue('notifications');
    }
}
