<?php


namespace Application\Services\Users;


use Application\Commands\Command\Users\CreateUserCommand;
use Application\Exceptions\EntityNotFoundException;
use Application\Services\Hash\HashServiceInterface;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    private HashServiceInterface $hashService;

    private UserRepositoryInterface $repository;

    private function __construct(
        HashServiceInterface $hashService,
        UserRepositoryInterface $repository
    )
    {
        $this->hashService = $hashService;
        $this->repository = $repository;
    }


    public function findUserByUsernameOrFail(string $username)
    {
        $user = $this->repository->findOneByUsername($username);

        if(!isset($user))
        {
            throw new EntityNotFoundException("User with username: $username not found");
        }

        return $user;
    }

    public function createFromCommand(CreateUserCommand $userCommand)
    {
        $user = new User();

        $user->setName($userCommand->getName());
        $user->setSurname($userCommand->getSurname());
        $user->setUsername($userCommand->getUsername());
        $user->setEmail($userCommand->getEmail());
        $user->setIsActive(false);
        $user->setPassword($this->hashService->make($userCommand->getPassword()));

        return $user;
    }

    public function persist(User $user)
    {
        $this->repository->persist($user);
    }
}
