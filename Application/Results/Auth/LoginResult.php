<?php


namespace Application\Results\Auth;


use Domain\Entities\User;

class LoginResult implements LoginResultInterface
{

    public function getUser(): User
    {
        // TODO: Implement getUser() method.
        throw new \Exception('not implemented function');
    }

    public function setUser(User $user): void
    {
        // TODO: Implement setUser() method.
    }
}
