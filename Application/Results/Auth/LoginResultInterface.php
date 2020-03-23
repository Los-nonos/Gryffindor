<?php


namespace Application\Results\Auth;


use Domain\Entities\User;

interface LoginResultInterface
{
    public function getUser(): User;

    public function setUser(User $user): void;
}
