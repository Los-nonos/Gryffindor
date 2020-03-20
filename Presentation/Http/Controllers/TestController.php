<?php
declare(strict_types=1);

namespace Presentation\Http\Controllers;

use Application\Commands\IndexTestCommand;
use Domain\CommandBus\CommandBusInterface;

final class TestController
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * TestController constructor.
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     *  Testing method phrase
     */
    public function index()
    {
        $command = new IndexTestCommand('Name', 'Lastname');

        echo $this->commandBus->handle($command);
    }
}
