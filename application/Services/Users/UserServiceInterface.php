<?php


namespace Application\Services\Users;


use Application\Commands\Command\Users\CreateUserCommand;
use Application\Exceptions\EntityNotFoundException;
use Domain\Entities\User;

interface UserServiceInterface
{
    /**
     * @param string $username
     * @throws EntityNotFoundException
     * @return User
     */
    public function findUserByUsernameOrFail(string $username);

    /**
     * @param CreateUserCommand $userCommand
     * @return User
     */
    public function createFromCommand(CreateUserCommand $userCommand);

    /**
     * @param User $user
     * @return void
     */
    public function persist(User $user);
}
