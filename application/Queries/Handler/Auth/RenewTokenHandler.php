<?php


namespace Application\Queries\Handler\Auth;


use Application\Results\Auth\RenewTokenResult;
use Application\Services\Token\TokenLoginServiceInterface;
use Application\Services\Token\GenerateRandomTokenService;
use DateTime;
use Domain\Entities\Token;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class RenewTokenHandler implements HandlerInterface
{
    private RenewTokenResult $result;

    private TokenLoginServiceInterface $tokenService;

    private GenerateRandomTokenService $randomTokenService;

    public function __construct(
        RenewTokenResult $result,
        TokenLoginServiceInterface $tokenService,
        GenerateRandomTokenService $randomTokenService
    )
    {
        $this->result = $result;
        $this->tokenService = $tokenService;
        $this->randomTokenService = $randomTokenService;
    }


    public function handle($query): ResultInterface
    {
        $token = $this->tokenService->findOneByHashOrFail($query->getToken());

        $token->setUpdatedAt(new DateTime());

        $token->setHash($this->randomTokenService->generate(Token::LENGTH));

        $this->tokenService->update();

        $this->result->setToken($token);
        return $this->result;
    }
}
