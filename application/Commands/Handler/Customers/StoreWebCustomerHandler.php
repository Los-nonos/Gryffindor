<?php


namespace Application\Commands\Handler\Customers;


use Application\Commands\Command\Customers\StoreWebCustomerCommand;
use Application\Commands\Command\Users\CreateUserCommand;
use Application\Services\Customers\CustomerServiceInterface;
use Application\Services\Notification\NotifiableService;
use Application\Services\Token\TokenLoginServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Domain\Entities\Customer;
use Domain\Entities\User;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreWebCustomerHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    private NotifiableService $notifiableService;

    private TokenLoginServiceInterface $tokenService;

    public function __construct(
        UserServiceInterface $userService,
        NotifiableService $notifiableService,
        TokenLoginServiceInterface $tokenLoginService
    )
    {
        $this->userService = $userService;
        $this->notifiableService = $notifiableService;
        $this->tokenService = $tokenLoginService;
    }

    /**
     * @param StoreWebCustomerCommand $command
     */
    public function handle($command): void
    {
        $customer = new Customer();
        $customer->setEmail($command->getEmail());

        $userCommand = $this->createUserCommand($command);

        $user = $this->userService->createFromCommand($userCommand);
        $user->setCustomer($customer);

        $this->userService->persist($user);

        $notifiable = $this->createEmailToActivateAccount($user);
        $notifiable->setName($command->getName() . " " . $command->getSurname());
        $notifiable->setEmail($command->getEmail());
        $this->notifiableService->sendEmail($notifiable);
    }

    private function createEmailToActivateAccount(User $user): NotifiableInterface
    {
        $notifiable = $this->notifiableService->notificationNotificationData();
        $url = env('APP_URL', 'http://zeepcommerce.com');
        $companyName = env('APP_NAME', 'Zeep Commerce');
        $notifiable->setUrlAction($url);
        $notifiable->setSubject('Activate your account');

        $token = $this->tokenService->findOrCreateToken($user);
        $this->tokenService->persist($token);
        $payload = [ 'id' => $user->getId(), 'name' => $user->getName(), 'surname' => $user->getSurname() ];

        $tokenActivateAccount = "$url/activate?token=".$this->tokenService->createTokenJWT($payload);

        $notifiable->setMessage("Welcome to $companyName! \n please active your account here: $tokenActivateAccount \n this url is valid for one hour only");
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
