<?php

declare(strict_types=1);

namespace Application\Handlers\Users;

use Application\Commands\Users\UpdateUserCommand;
use Application\Results\Users\UpdateUserResultInterface;
use Domain\Entities\User;
use Domain\Interfaces\UserRepositoryInterface;
use Exception;

class UpdateUserHandler
{
    /**
     * @var UserRepositoryInterface $userRepository
     */
    private $userRepository;

    /**
     * @var UpdateUserResultInterface $updateUserResult
     */
    private $updateUserResult;

    /**
     * CreateUserHandler constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UpdateUserResultInterface $updateUserResult
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UpdateUserResultInterface $updateUserResult
    ) {
        $this->userRepository = $userRepository;
        $this->updateUserResult = $updateUserResult;
    }

    /**
     * @param UpdateUserCommand $updateUserCommand
     * @return UpdateUserResultInterface
     * @throws Exception
     */
    public function handle(UpdateUserCommand $updateUserCommand): UpdateUserResultInterface
    {
        $user = null;

        $this->updateUserFormCommand($updateUserCommand, $user);

        //$this->userRepository->save($user);

        $this->updateUserResult->setUser($user);

        return $this->updateUserResult;
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
