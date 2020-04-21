<?php

declare(strict_types=1);

namespace Application\Handlers\Users;

use Application\Commands\Users\UpdateUserCommand;
use Application\Results\Users\UpdateUserResultInterface;
use Application\Validators\Users\UpdateUserValidatorInterface;
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
     * @var UpdateUserValidatorInterface $updateUserValidator
     */
    private $updateUserValidator;

    /**
     * @var UpdateUserResultInterface $updateUserResult
     */
    private $updateUserResult;

    /**
     * CreateUserHandler constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UpdateUserValidatorInterface $updateUserValidator
     * @param UpdateUserResultInterface $updateUserResult
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UpdateUserValidatorInterface $updateUserValidator,
        UpdateUserResultInterface $updateUserResult
    ) {
        $this->userRepository = $userRepository;
        $this->updateUserValidator = $updateUserValidator;
        $this->updateUserResult = $updateUserResult;
    }

    /**
     * @param UpdateUserCommand $updateUserCommand
     * @return UpdateUserResultInterface
     * @throws Exception
     */
    public function handle(UpdateUserCommand $updateUserCommand): UpdateUserResultInterface
    {
        $user = $this->updateUserValidator->validate($updateUserCommand);

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
