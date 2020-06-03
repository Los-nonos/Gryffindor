<?php


namespace Application\Commands\Handler\Auth;


use Application\Commands\Command\Auth\ChangePasswordCommand;
use Application\Services\Hash\HashServiceInterface;
use Application\Services\Users\UserServiceInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class ChangePasswordHandler implements HandlerInterface
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
     * @param ChangePasswordCommand $command
     */
    public function handle($command): void
    {
        $user = $this->userService->findOneByEmailOrFail($command->getEmail());

        $user->setPassword($this->hashService->make($command->getPassword()));

        $this->userService->persist($user);
    }
}
