<?php


namespace Application\Commands\Handler\Customers;


use Application\Commands\Command\Customers\UpdateCustomerCommand;
use Application\Services\Customers\CustomerServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class UpdateCustomerHandler implements HandlerInterface
{
    private CustomerServiceInterface $customerService;

    public function __construct(
        CustomerServiceInterface $customerService
    )
    {
        $this->customerService = $customerService;
    }

    /**
     * @param UpdateCustomerCommand $command
     */
    public function handle($command): void
    {
        $user = $this->customerService->findOneByUserIdOrFail($command->getId());

        $customer = $user->getCustomer();
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
}
