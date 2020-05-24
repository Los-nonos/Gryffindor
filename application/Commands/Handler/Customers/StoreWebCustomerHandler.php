<?php


namespace Application\Commands\Handler\Customers;


use Application\Commands\Command\Customers\StoreWebCustomerCommand;
use Application\Commands\Command\Users\CreateUserCommand;
use Application\Services\Customers\CustomerServiceInterface;
use Application\Services\Notification\NotifiableService;
use Application\Services\Users\UserServiceInterface;
use Domain\Entities\Customer;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreWebCustomerHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    private NotifiableService $notifiableService;

    public function __construct(
        UserServiceInterface $userService,
        NotifiableService $notifiableService
    )
    {
        $this->userService = $userService;
        $this->notifiableService = $notifiableService;
    }

    /**
     * @param StoreWebCustomerCommand $command
     */
    public function handle($command): void
    {
        $customer = new Customer();
        $customer->setEmail($command->getEmail());

        $notifiable = $this->createEmailToActivateAccount();
        $notifiable->setEmail($command->getEmail());

        $userCommand = $this->createUserCommand($command);

        $user = $this->userService->createFromCommand($userCommand);
        $user->setCustomer($customer);

        $this->userService->persist($user);

        $this->notifiableService->sendEmail($notifiable);
    }

    private function createEmailToActivateAccount(): NotifiableInterface
    {
        $notifiable = $this->notifiableService->notificationNotificationData();
        $url = env('APP_URL', null);
        $companyName = env('APP_NAME', 'Zeep Commerce');
        $notifiable->setUrlAction($url);
        $notifiable->setSubject('Activate your account');

        //TODO: add token for activate account
        $tokenActivateAccount = '';

        $notifiable->setMessage("Welcome to $companyName! \n please active your account here: $tokenActivateAccount \n this url is valid for one week only");
        return $notifiable;
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
