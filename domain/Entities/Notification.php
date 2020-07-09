<?php


namespace Domain\Entities;


class Notification
{
    private int $id;

    private string $email;

    private string $role;

    private string $message;

    private bool $notificationRead;
    private string $subject;

    public function __construct()
    {
        $this->notificationRead = false;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return bool
     */
    public function isRead(): bool
    {
        return $this->notificationRead;
    }

    /**
     * @param bool $read
     */
    public function setRead(bool $read): void
    {
        $this->notificationRead = $read;
    }

    public function setSubject(string $subject)
    {
        $this->subject = $subject;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }
}
