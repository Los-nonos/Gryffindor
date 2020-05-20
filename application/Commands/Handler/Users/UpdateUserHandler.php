<?php

declare(strict_types=1);

namespace Application\Commands\Handler\Users;

use Application\Commands\Command\Users\UpdateUserCommand;
use Domain\Entities\User;
use Domain\Interfaces\UserRepositoryInterface;
use Exception;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class UpdateUserHandler implements HandlerInterface
{
    /**
     * @var UserRepositoryInterface $userRepository
     */
    private $userRepository;

    /**
     * CreateUserHandler constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateUserCommand $updateUserCommand
     * @throws Exception
     */
    public function handle($updateUserCommand): void
    {
        $user = null;

        $this->updateUserFormCommand($updateUserCommand, $user);

        //$this->userRepository->save($user);
    }

    /**
     * @param UpdateUserCommand $updateUserCommand
     * @param User $user
     * @return User
     */
    private function updateUserFormCommand(UpdateUserCommand $updateUserCommand, User $user): User
    {
        $user->setName($updateUserCommand->getName());
        $user->setEmail($updateUserCommand->getEmail());
        $user->setPassword($updateUserCommand->getPassword());

        return $user;
    }
}
