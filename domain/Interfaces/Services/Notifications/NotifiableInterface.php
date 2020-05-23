<?php


namespace Domain\Interfaces\Services\Notifications;


use Domain\Enums\Priority;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

interface NotifiableInterface
{
    public function getId(): int;
    public function getUserId(): int;
    public function getName(): string;
    public function getSurname(): string;
    public function getEmail(): string;
    public function getSubject(): string;
    public function getMessage(): string;
    public function getUrlAction(): string;
    public function getPriority(): string;
    public function setName(string $name):void;
    public function setSurname(string $surname):void;
    public function setEmail(string $email):void;
    public function setSubject(string $subject):void;
    public function setMessage(string $message):void;
    public function setUrlAction(string $urlAction):void;
    public function setPriority(Priority $priority): void;
    public function emailNotification(NotifiableInterface $notifiable): Mailable;
    public function internalNotification(NotifiableInterface $notifiable): Notification;
}
