<?php


namespace Domain\ValueObjects;


use Domain\Interfaces\Services\Notifications\NotifiableInterface;

abstract class Notification implements NotifiableInterface
{
    private int $id;
    private int $userId;
    private string $email;
    private string $name;
    private string $surname;
    private string $subject;
    private string $message;
    private string $urlAction;
    // enum(low-medium-high) private string $priority;

    public function getId(): int{
        return $this->id;
    }

    public function getUserId(): int{
        return $this->userId;
    }

    public function getEmail(): string{
        return $this->email;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getSurname(): string{
        return $this->surname;
    }

    public function getSubject(): string{
        return $this->subject;
    }

    public function getMessage(): string{
        return $this->message;
    }

    public function getUrlAction(): string{
        return $this->urlAction;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setSurname(string $surname): void{
        $this->surname = $surname;
    }

    public function setSubject(string $subject): void {
        $this->subject = $subject;
    }

    public function setMessage(string $message): void {
        $this->message = $message;
    }

    public function setUrlAction(string $urlAction): void
    {
        $this->urlAction = $urlAction;
    }
}
