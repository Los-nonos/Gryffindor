<?php


namespace Application\Commands\Command\Auth;


use Infrastructure\CommandBus\Command\CommandInterface;

class ChangePasswordCommand implements CommandInterface
{
    private int $id;
    private string $oldPassword;
    private string $newPassword;

    public function __construct($id, $oldPassword, $newPassword)
    {
        $this->id = $id;
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
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
    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    /**
     * @return string
     */
    public function getNewPassword(): string
    {
        return $this->newPassword;
    }
}
