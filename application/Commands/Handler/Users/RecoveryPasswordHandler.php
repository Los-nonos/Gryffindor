<?php


namespace Application\Commands\Handler\Users;


use Application\Commands\Command\Users\RecoveryPasswordCommand;
use Application\Services\Notification\NotifiableServiceInterface;
use Application\Services\Token\TokenLoginServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Domain\Entities\User;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class RecoveryPasswordHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    private NotifiableServiceInterface $notifiableService;

    private TokenLoginServiceInterface $tokenService;

    public function __construct(
        UserServiceInterface $userService,
        NotifiableServiceInterface $notifiableService,
        TokenLoginServiceInterface $tokenLoginService
    )
    {
        $this->userService = $userService;
        $this->notifiableService = $notifiableService;
        $this->tokenService = $tokenLoginService;
    }

    /**
     * @param RecoveryPasswordCommand $command
     */
    public function handle($command): void
    {
        $user = $this->userService->findOneByEmailOrFail($command->getEmail());

        $notifiable = $this->createEmailToActivateAccount($user);
        $notifiable->setName($user->getName() . " " . $user->getSurname());
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

        $tokenActivateAccount = "$url/recovery?token=".$this->tokenService->createTokenJWT($payload);

        $notifiable->setMessage("You have requested to change your password, access this link to continue: \n\n $tokenActivateAccount \n\n this url is valid for one hour only");
        return $notifiable;
    }
}
