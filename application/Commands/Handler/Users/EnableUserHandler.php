<?php


namespace Application\Commands\Handler\Users;


use Application\Services\Users\UserServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class EnableUserHandler implements HandlerInterface
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

        $user->setIsActive(true);

        $this->userService->update();
    }
}
