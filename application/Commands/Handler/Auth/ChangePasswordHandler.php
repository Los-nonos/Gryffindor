<?php


namespace Application\Commands\Handler\Auth;


use Application\Commands\Command\Auth\ChangePasswordCommand;
use Application\Exceptions\PasswordNotMatch;
use Application\Services\Hash\HashServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Infrastructure\CommandBus\Command\CommandInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class ChangePasswordHandler implements HandlerInterface
{
    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;
    /**
     * @var HashServiceInterface
     */
    private HashServiceInterface $hashService;

    public function __construct(
        UserServiceInterface $userService,
        HashServiceInterface $hashService
    )
    {
        $this->userService = $userService;
        $this->hashService = $hashService;
    }

    /**
     * @param ChangePasswordCommand $command
     * @throws PasswordNotMatch
     */
    public function handle($command): void
    {
        $user = $this->userService->findOneByIdOrFail($command->getId());

        if(!$this->hashService->check($command->getOldPassword(), $user->getPassword())) {
            throw new PasswordNotMatch();
        }

        $user->setPassword($this->hashService->make($command->getNewPassword()));

        $this->userService->persist($user);
    }
}
