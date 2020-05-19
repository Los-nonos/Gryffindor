<?php


namespace Application\Results\Auth;


use Domain\Entities\Token;
use Domain\Entities\User;

interface LoginResultInterface
{
    public function getUser(): User;
    public function getToken(): Token;
    public function setUser(User $user): void;
    public function setToken(Token $token): void;
}
