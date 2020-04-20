<?php


namespace Application\Services\Notification;

use Application\Jobs\EmailNotificationJob;
use Domain\Interfaces\Services\Notifications\MailableInterface;
use Domain\Interfaces\Services\Notifications\NotificationInterface;

class EmailNotificationService implements EmailNotificationServiceInterface
{
    private GenerateEmailNotificationService $generateEmailNotificationService;
    private MailableInterface $mailable;

    public function __construct(GenerateEmailNotificationService $generateEmailNotificationService,
                                MailableInterface $mailable)
    {
        $this->generateEmailNotificationService = $generateEmailNotificationService;
        $this->mailable = $mailable;
    }

    public function notificationData(): NotificationInterface
    {
        return $this->generateEmailNotificationService->generate();
    }

    public function sendEmail(NotificationInterface $data): void
    {
        EmailNotificationJob::dispatch($this->mailable->emailNotification($data))->onQueue('emails');
    }
}
