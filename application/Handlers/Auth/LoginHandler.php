<?php

namespace Application\Handlers\Auth;


use Application\Commands\Auth\LoginCommand;
use Application\Exceptions\EntityNotFoundException;
use Application\Exceptions\PasswordNotMatch;
use Application\Results\Auth\LoginResult;
use Application\Results\Auth\LoginResultInterface;
use Application\Services\Hash\HashServiceInterface;
use Application\Services\Token\TokenLoginServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Domain\Interfaces\UserRepositoryInterface;
use Exception;

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
     * @param LoginCommand $command
     * @return LoginResultInterface
     * @throws Exception
     */
    public function execute(LoginCommand $command): LoginResultInterface
    {
        $user = $this->userService->findUserByUsernameOrFail($command->getUsername());


        if($this->hashService->VerificateHash($user->getPassword(), $command->getPassword()))
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
