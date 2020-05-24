<?php


namespace Application\Commands\Handler\Users;


use Application\Services\Users\UserServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;

class DisableUserHandler
{
    private UserServiceInterface $userService;

    public function __construct(
        UserServiceInterface $userService
    )
    {
        $this->userService = $userService;
    }

    public function handle(CommandInterface $command): void
    {
        $user = $this->userService->findOneByIdOrFail($command->getId());

        $user->setIsActive(false);

        $this->userService->update();
    }
}
