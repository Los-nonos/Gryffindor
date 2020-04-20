<?php


namespace Domain\Interfaces\Services\Notifications;


use Illuminate\Mail\Mailable;

interface NotificationInterface
{
    public function getId(): int;
    public function getName(): string;
    public function getSurname(): string;
    public function getEmail(): string;
    public function getSubject(): string;
    public function getMessage(): string;
    public function setName(string $name):void;
    public function setSurname(string $surname):void;
    public function setEmail(string $email):void;
    public function setSubject(string $subject):void;
    public function setMessage(string $message):void;
    public function emailNotification(NotificationInterface $data): Mailable;
}
