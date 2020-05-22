<?php


namespace Application\Queries\Results\Auth;


use Domain\Entities\Token;
use Infrastructure\QueryBus\Result\ResultInterface;

class RenewTokenResult implements ResultInterface
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
