<?php

declare(strict_types=1);

namespace Application\Validators\Users;

use Application\Commands\User\UpdateUserCommand;
use Application\Exceptions\EntityNotFoundException;
use Domain\Entities\User;
use Domain\Interfaces\UserRepositoryInterface;
use Exception;

final class UpdateUserValidator implements UpdateUserValidatorInterface
{
    /**
     * @var UserRepositoryInterface $userRepository
     */
    private UserRepositoryInterface $userRepository;

    /**
     * CreateUserHandler constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateUserCommand $updateUserCommand
     * @return User
     * @throws Exception
     */
    public function validate($updateUserCommand) : User
    {
        $user = $this->userRepository->getById($updateUserCommand->getId());

        if (!$user) {
            throw new EntityNotFoundException('User not found');
        }

        if ($user->getEmail() !== $updateUserCommand->getEmail()) {
            if ($this->userRepository->existWithTheEmail($updateUserCommand->getEmail())) {
                throw new Exception('This email is used by another account');
            }
        }

        return $user;
    }


}
