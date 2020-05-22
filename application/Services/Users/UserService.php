<?php


namespace Application\Services\Users;


use Application\Commands\Command\Users\CreateUserCommand;
use Application\Exceptions\EntityNotFoundException;
use Application\Services\Hash\HashServiceInterface;
use Domain\Entities\User;

class UserService implements UserServiceInterface
{
    private HashServiceInterface $hashService;

    private function __construct(
        HashServiceInterface $hashService
    )
    {
        $this->hashService = $hashService;
    }


    public function findUserByUsernameOrFail(string $username)
    {
        // TODO: Implement findUserByUsernameOrFail() method.
    }

    public function createFromCommand(CreateUserCommand $userCommand)
    {
        $user = new User();
        $user->setName($userCommand->getName());
        $user->setSurname($userCommand->getSurname());
        $user->setUsername($userCommand->getUsername());
        $user->setEmail($userCommand->getEmail());
        $user->setPassword($this->hashService->Hash($userCommand->getPassword(), "", ""));

    }

    public function persist(User $user)
    {

    }
}
