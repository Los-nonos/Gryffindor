<?php


namespace Application\Results\Auth;


use Domain\Entities\Token;

class RenewTokenResult
{
    /**
     * @var Token
     */
    private $token;

    public function setToken(Token $token){
        $this->token = $token;
    }

    public function getToken(): Token
    {
        return $this->token;
    }
}
