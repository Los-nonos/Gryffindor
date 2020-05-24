<?php


namespace Application\Commands\Handler\Customers;


use Application\Commands\Command\Customers\StoreWebCustomerCommand;
use Application\Commands\Command\Users\CreateUserCommand;
use Application\Services\Customers\CustomerServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Domain\Entities\Customer;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreWebCustomerHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    private CustomerServiceInterface $customerService;

    public function __construct(
        UserServiceInterface $userService,
        CustomerServiceInterface $customerService
    )
    {
        $this->userService = $userService;
        $this->customerService = $customerService;
    }

    /**
     * @param StoreWebCustomerCommand $command
     */
    public function handle($command): void
    {
        $customer = new Customer();
        $customer->setEmail($command->getEmail());
        $this->customerService->persist($customer);

        $userCommand = $this->createUserCommand($command);

        $user = $this->userService->createFromCommand($userCommand);
        $user->setCustomer($customer);

        $this->userService->persist($user);
    }

    private function createUserCommand(StoreWebCustomerCommand $command): CreateUserCommand
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
