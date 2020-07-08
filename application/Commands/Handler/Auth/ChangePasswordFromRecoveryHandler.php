<?php


namespace Application\Commands\Handler\Auth;


use Application\Commands\Command\Auth\ChangePasswordFromRecoveryCommand;
use Application\Services\Hash\HashServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class ChangePasswordFromRecoveryHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

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
     * @param ChangePasswordFromRecoveryCommand $command
     */
    public function handle($command): void
    {
        $user = $this->userService->findOneByEmailOrFail($command->getEmail());

        $user->setPassword($this->hashService->make($command->getPassword()));

        $this->userService->persist($user);
    }
}
