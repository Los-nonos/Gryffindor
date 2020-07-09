<?php


namespace Domain\ValueObjects;


use Application\Events\EmailNotificationEventData;
use Domain\Enums\Priority;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class Notification implements NotifiableInterface
{
    private int $id;
    private int $userId;
    private $email;
    private $emailFrom;
    private $name;
    private $surname;
    private $subject;
    private $message;
    private $urlAction;
    private Priority $priority;
    private $nameFrom;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getUrlAction(): string
    {
        return $this->urlAction;
    }

    public function getPriority(): string
    {
        return $this->priority;
    }


    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
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

    public function setPriority(Priority $priority): void
    {
        $this->priority = $priority;
    }

    public function emailNotification(): Mailable
    {
        return new EmailNotificationEventData($this);
    }

    public function internalNotification(NotifiableInterface $notifiable): \Domain\Entities\Notification
    {
        $notification = new \Domain\Entities\Notification();
        $notification->setEmail($this->getEmail());
        $notification->setMessage($this->getMessage());
        $notification->setRole($this->getSubject()); //TODO : search role from userId and save or added role field in notification

        return $notification;
    }

    public function setEmailFrom($email): void
    {
        $this->emailFrom = $email;
    }

    public function getEmailFrom(): string
    {
        return $this->emailFrom;
    }

    public function setNameFrom($name)
    {
        $this->nameFrom = $name;
    }

    public function getNameFrom(): string
    {
        return $this->nameFrom;
    }
}
