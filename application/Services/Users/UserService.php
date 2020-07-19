<?php


namespace Application\Services\Users;


use Application\Commands\Command\Users\CreateUserCommand;
use Application\Exceptions\EmailAlreadyRegistered;
use Application\Exceptions\EntityNotFoundException;
use Application\Exceptions\UsernameAlreadyRegistered;
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
        $user = $this->findOneUserByUsername($username);

        if(!isset($user))
        {
            throw new EntityNotFoundException("User with username: $username not found");
        }

        return $user;
    }

    private function findOneUserByUsername(string $username): ?User
    {
        return $this->repository->findOneByUsername($username);
    }

    /**
     * @param CreateUserCommand $userCommand
     * @return User
     * @throws EmailAlreadyRegistered|UsernameAlreadyRegistered
     */
    public function createFromCommand(CreateUserCommand $userCommand)
    {
        if($this->existWithEmail($userCommand->getEmail())){
            throw new EmailAlreadyRegistered();
        }

        $user = $this->findOneUserByUsername($userCommand->getUsername());

        if($user) {
            throw new UsernameAlreadyRegistered();
        }

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
     */
    public function findOneByEmailOrFail(string $email): User
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

    public function findEmployees($page, $size): array
    {
        $page = $page ? $page : 1;
        $size = $size ? $size : 10;

        return $this->repository->findEmployees($page, $size);
    }

    public function findCustomers($page, $size, $name, $dni, $cuil)
    {
        $page = $page ? $page : 1;
        $size = $size ? $size : 10;

        return $this->repository->findCustomers($page, $size, $name, $dni, $cuil);
    }
}
