<?php

declare(strict_types=1);

namespace Presentation\Interfaces;

use Application\Results\User\UpdateUserResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;
use Presentation\Http\Presenters\User\UpdateUserPresenter;

interface UpdateUserPresenterInterface extends PresenterInterface
{
    public function fromResult(UpdateUserResult $result): UpdateUserPresenter;
}