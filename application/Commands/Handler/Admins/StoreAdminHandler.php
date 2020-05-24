<?php


namespace Application\Commands\Handler\Admins;


use Application\Commands\Command\Admins\StoreAdminCommand;
use Application\Commands\Command\Users\CreateUserCommand;
use Application\Services\Users\UserServiceInterface;
use Domain\Entities\Admin;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreAdminHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    public function __construct(
        UserServiceInterface $userService
    )
    {
        $this->userService = $userService;
    }

    /**
     * @param StoreAdminCommand $command
     */
    public function handle($command): void
    {
        $admin = new Admin();
        $admin->setRole($command->getRole());

        $userCommand = $this->createUserCommand($command);

        $user = $this->userService->createFromCommand($userCommand);
        $user->setAdmin($admin);
        $user->setIsActive(true);
        $this->userService->persist($user);
    }

    private function createUserCommand(StoreAdminCommand $command): CreateUserCommand
    {
        return new CreateUserCommand(
            $command->getName(),
            $command->getSurname(),
            $command->getUsername(),
            $command->getPassword(),
            $command->getEmail()
        );
    }
}
