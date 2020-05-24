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

    public function __construct(
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

    /**
     * @param int $id
     * @return User
     * @throws EntityNotFoundException
     */
    public function findOneByIdOrFail(int $id): User
    {
        $user = $this->repository->findOneById($id);

        if(!isset($user))
        {
            throw new EntityNotFoundException("User with id $id not found");
        }

        return $user;
    }

    /**
     * @param string $email
     * @return User
     * @throws EntityNotFoundException
     * @noinspection PhpHierarchyChecksInspection
     */
    public function findOneByEmailOrFail(string $email)
    {
        $user = $this->repository->findOneByTheEmail($email);

        if(!isset($user))
        {
            throw new EntityNotFoundException("User with email $email does not exist");
        }

        return $user;
    }

    public function existWithEmail(string $email): bool
    {
        return $this->repository->existWithTheEmail($email);
    }

    public function update()
    {
        $this->repository->flush();
    }
}
