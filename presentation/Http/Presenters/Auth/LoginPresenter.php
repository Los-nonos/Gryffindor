<?php


namespace Presentation\Http\Presenters\Auth;


use Application\Queries\Results\Auth\LoginResult;
use Application\Results\Auth\LoginResultInterface;
use Domain\Interfaces\Services\GetUserTypeServiceInterface;
use Firebase\JWT\JWT;

class LoginPresenter
{
    private LoginResult $result;
    private GetUserTypeServiceInterface $getUserTypeService;

    public function __construct(GetUserTypeServiceInterface $getUserTypeService)
    {
        $this->getUserTypeService = $getUserTypeService;
    }


    public function fromResult($result): LoginPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $user = $this->result->getToken()->getUser();

        $userTypes = $this->getUserTypeService->handle($user);

//        $userRoles = [];
//
//        if($userTypes[$this->getUserTypeService::USER_ADMIN] != null){
//            array_push($userRoles, 'CompanyAdmin');
//        }
//
//        if($userTypes[$this->getUserTypeService::USER_CUSTOMER] != null){
//            array_push($userRoles, 'Teacher');
//        }

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
            'token' => $this->toJWT($userArray)
        ];
    }

    public function toJWT($payload)
    {
        $key = "key";//todo: definir key
        return JWT::encode($payload, $key);
    }
}
