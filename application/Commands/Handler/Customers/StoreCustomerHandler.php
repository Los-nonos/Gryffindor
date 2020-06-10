<?php


namespace Application\Commands\Handler\Customers;


use Application\Commands\Command\Customers\StoreCustomerCommand;
use Application\Commands\Command\Users\CreateUserCommand;
use Application\Exceptions\EmailAlreadyRegistered;
use Application\Services\Customers\CustomerServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Domain\Entities\Customer;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreCustomerHandler implements HandlerInterface
{
    private CustomerServiceInterface $customerService;

    private UserServiceInterface $userService;

    public function __construct(
        CustomerServiceInterface $customerService,
        UserServiceInterface $userService
    )
    {
        $this->customerService = $customerService;
        $this->userService = $userService;
    }

    /**
     * @param StoreCustomerCommand $command
     * @throws EmailAlreadyRegistered
     */
    public function handle($command): void
    {
        $user = null;
        $customer = null;

        if($this->userService->existWithEmail($command->getEmail()))
        {
            $user = $this->userService->findOneByEmailOrFail($command->getEmail());
            if(!$user->isCustomer())
            {
                throw new EmailAlreadyRegistered("the email is already registered for another type of user");
            }

            $customer = $user->getCustomer();
        }
        else
        {
            $userCommand = $this->createUserCommand($command);
            $user = $this->userService->createFromCommand($userCommand);
            $customer = new Customer();
            $user->setCustomer($customer);

            $this->userService->persist($user);
        }

        $customer->setAge($command->getAge());
        $customer->setCity($command->getCity());
        $customer->setState($command->getState());
        $customer->setCountry($command->getCountry());
        $customer->setPostalCode($command->getPostalCode());
        $customer->setCellPhone($command->getCellPhone());
        $customer->setVatCondition($command->getVatCondition());
        $customer->setTaxationKey($command->getTaxationKey());
        $customer->setGrossIncome($command->getGrossIncome());

        $this->customerService->update();
    }

    private function createUserCommand(StoreCustomerCommand $command): CreateUserCommand
    {
        return new CreateUserCommand(
            $command->getName(),
            $command->getSurname(),
            null,
            null,
            $command->getEmail(),
        );
    }
}
