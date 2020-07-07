<?php


namespace Presentation\Http\Presenters\Auth;


use Application\Queries\Results\Auth\LoginResult;
use Application\Queries\Results\Auth\RenewTokenResult;
use Application\Results\Auth\LoginResultInterface;
use Application\Services\Token\TokenLoginServiceInterface;
use Domain\Interfaces\Services\GetUserTypeServiceInterface;
use Firebase\JWT\JWT;

class LoginPresenter
{
    /**
     * @var LoginResult|RenewTokenResult
     */
    private $result;
    private GetUserTypeServiceInterface $getUserTypeService;
    private TokenLoginServiceInterface $tokenLoginService;

    public function __construct(
        GetUserTypeServiceInterface $getUserTypeService,
        TokenLoginServiceInterface $tokenLoginService
    )
    {
        $this->tokenLoginService = $tokenLoginService;
        $this->getUserTypeService = $getUserTypeService;
    }


    public function fromResult($result): LoginPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $user = $this->result->getToken()->getUser();

        $userTypes = $this->getUserTypeService->handle($user);

        $userArray = [
            'id' => $user->getId(),
            'firstName' => $user->getName(),
            'lastName' => $user->getSurname(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'roles' => $userTypes,
        ];

        return [
            'user' => $userArray,
            'token' => $this->tokenLoginService->createTokenJWT($userArray)
        ];
    }
}
