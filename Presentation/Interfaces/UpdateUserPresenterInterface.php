<?php

declare(strict_types=1);

namespace Presentation\Interfaces;

use Application\Results\Users\UpdateUserResultInterface;
use Infrastructure\Presenter\Contracts\PresenterInterface;

interface UpdateUserPresenterInterface extends PresenterInterface
{
    public function fromResult(UpdateUserResultInterface $result): UpdateUserPresenterInterface;
}
