<?php


namespace Application\Results\Auth;


use Domain\Entities\User;

interface LoginResultInterface
{
    public function getUser(): User;
    public function getToken(): string;
    public function setUser(User $user): void;
    public function setToken(string $token): void;
}
