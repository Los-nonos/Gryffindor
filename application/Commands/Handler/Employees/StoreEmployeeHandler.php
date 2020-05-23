<?php


namespace Application\Commands\Handler\Employees;


use Application\Commands\Command\Employees\StoreEmployeeCommand;
use Application\Commands\Command\Users\CreateUserCommand;
use Application\Exceptions\RoleInvalid;
use Application\Services\Users\UserServiceInterface;
use Domain\Entities\Employee;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreEmployeeHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    public function __construct(
        UserServiceInterface $userService
    )
    {
        $this->userService = $userService;
    }

    /**
     * @param StoreEmployeeCommand $command
     * @throws RoleInvalid
     */
    public function handle($command): void
    {
        $employee = new Employee();
        $employee->setRoles($command->getRole());

        $userCommand = $this->createUserCommand($command);

        $user = $this->userService->createFromCommand($userCommand);
        $user->setIsActive(true);
        $user->setEmployee($employee);

        $this->userService->persist($user);
    }

    private function createUserCommand(StoreEmployeeCommand $command): CreateUserCommand
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
