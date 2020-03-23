<?php

namespace Application\Handlers\Auth;


use Application\Commands\Auth\LoginCommand;
use Application\Exceptions\EntityNotFoundException;
use Application\Exceptions\PasswordNotMatch;
use Application\Results\Auth\LoginResult;
use Application\Results\Auth\LoginResultInterface;
use Application\Services\HashServiceInterface;
use Domain\Interfaces\UserRepositoryInterface;
use Exception;
use Tymon\JWTAuth\JWTAuth;

class LoginHandler
{
    private HashServiceInterface $hashService;
    private UserRepositoryInterface $userRepository;

    public function __construct(HashServiceInterface $hashService, UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->hashService = $hashService;
    }
    /**
     * @param LoginCommand $command
     * @return LoginResultInterface
     * @throws Exception
     */
    public function execute(LoginCommand $command): LoginResultInterface
    {
        $user = $this->userRepository->getByUsername($command->getUsername());

        if(!$user){
            throw new EntityNotFoundException("no user registered with username");
        }

        if($this->hashService->VerificateHash($user->getPassword(), $command->getPassword()))
        {
            $result = new LoginResult();
            $result->setUser($user);
            $credentials = ['username' => $command->getUsername(), 'roles' => $user->getRoles(), 'id' => $user->getId()];
            $token = JWTAuth::attempt($credentials);
            $result->setToken($token);

            return $result;
        }
        else
        {
            throw new PasswordNotMatch();
        }
    }
}
