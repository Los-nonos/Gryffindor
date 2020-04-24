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
    private string $messageAction;
    private string $urlAction;

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

    public function getMessageAction():string
    {
        return $this->messageAction;
    }

    public function getUrlAction(): string
    {
        return $this->urlAction;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setUrlAction(string $urlAction): void
    {
        $this->urlAction = $urlAction;
    }

    public function setMessageAction(string $messageAction): void
    {
        $this->messageAction = $messageAction;
    }
}
