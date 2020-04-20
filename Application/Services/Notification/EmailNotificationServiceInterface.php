<?php


namespace Application\Services\Notification;


use Domain\Interfaces\Services\Notifications\NotificationInterface;

interface EmailNotificationServiceInterface
{
    public function notificationData(): NotificationInterface;
    public function sendEmail(NotificationInterface $data): void;
}
