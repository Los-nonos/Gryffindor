<?php


namespace Infrastructure\CommandBus\Handler;


use Infrastructure\CommandBus\Command\CommandInterface;

interface HandlerInterface
{
    public function handle(CommandInterface $command): void;
}
