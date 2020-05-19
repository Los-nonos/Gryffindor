<?php


namespace Application\Services\Notification;


use Domain\Interfaces\Services\Notifications\NotifiableInterface;

interface NotifiableServiceInterface
{
    public function notificationEmailData(): NotifiableInterface;
    public function notificationNotificationData(): NotifiableInterface;
    public function sendEmail(NotifiableInterface $data): void;
    public function sendNotification(NotifiableInterface $data): void;
}
