<?php


namespace Application\Services\Notification;

use Application\Jobs\EmailNotificationJob;
use Application\Jobs\InternalNotificationJob;
use Domain\Interfaces\Services\Notifications\MailableInterface;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Domain\Interfaces\Services\Notifications\NotificationInterface;

class NotifiableService implements NotifiableServiceInterface
{
    private GenerateNotificationService $generateNotificationService;
    //private MailableInterface $mailable;
    private NotificationInterface $mailable;
    private NotificationInterface $notification;

    public function __construct(GenerateNotificationService $generateNotificationService,
                                NotificationInterface $mailable,
                                NotificationInterface $notification)
    {
        $this->generateNotificationService = $generateNotificationService;
        $this->mailable = $mailable;
        $this->notification = $notification;
    }

    public function notificationEmailData(): NotifiableInterface
    {
        return $this->generateNotificationService->generateEmailData();
    }

    public function sendEmail(NotifiableInterface $data): void
    {
        EmailNotificationJob::dispatch($this->mailable->emailNotification($data))->onQueue('emails');
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
