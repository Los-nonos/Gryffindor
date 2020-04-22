<?php


namespace Application\Services\Notification;


use Domain\Interfaces\Services\Notifications\NotifiableInterface;

interface EmailNotificationServiceInterface
{
    public function notificationData(): NotifiableInterface;
    public function sendEmail(NotifiableInterface $data): void;
}
