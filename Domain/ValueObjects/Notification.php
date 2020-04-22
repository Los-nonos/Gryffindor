<?php


namespace Domain\ValueObjects;

use Domain\Interfaces\Services\Notifications\NotifiableInterface;

abstract class Notification implements NotifiableInterface
{
    private int $id;
    //private User $user;
    //private enum priority;
    private int $userId;
    private string $subject;
    private string $message;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
