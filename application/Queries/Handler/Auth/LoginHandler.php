<?php

namespace Application\Queries\Handler\Auth;


use Application\Exceptions\PasswordNotMatch;
use Application\Queries\Query\Auth\LoginQuery;
use Application\Queries\Results\Auth\LoginResult;
use Application\Services\Hash\HashServiceInterface;
use Application\Services\Token\TokenLoginServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Exception;
use Infrastructure\QueryBus\Result\ResultInterface;

class LoginHandler
{
    private HashServiceInterface $hashService;
    private UserServiceInterface $userService;
    private TokenLoginServiceInterface $tokenLoginService;

    public function __construct(
        HashServiceInterface $hashService,
        UserServiceInterface $userService,
        TokenLoginServiceInterface $tokenLoginService
    )
    {
        $this->userService = $userService;
        $this->hashService = $hashService;
        $this->tokenLoginService = $tokenLoginService;
    }
    /**
     * @param LoginQuery $command
     * @return LoginResult
     * @throws Exception
     */
    public function execute(LoginQuery $command): ResultInterface
    {
        $user = $this->userService->findUserByUsernameOrFail($command->getUsername());


        if($this->hashService->check($user->getPassword(), $command->getPassword()))
        {
            $result = new LoginResult();
            $token = $this->tokenLoginService->createToken($user);

            $result->setToken($token);
            return $result;
        }
        else
        {
            throw new PasswordNotMatch();
        }
    }
}
