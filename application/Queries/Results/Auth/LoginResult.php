<?php


namespace Application\Queries\Results\Auth;


use Domain\Entities\Token;
use Domain\Entities\User;
use Infrastructure\QueryBus\Result\ResultInterface;

class LoginResult implements ResultInterface
{

    private Token $token;
    private User $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getToken(): Token
    {
        return $this->token;
    }

    public function setToken(Token $token): void
    {
        $this->token = $token;
    }
}
