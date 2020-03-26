<?php


namespace Presentation\Http\Presenters\Auth;


use Application\Results\Auth\LoginResultInterface;
use Presentation\Interfaces\LoginPresenterInterface;

class LoginPresenter implements LoginPresenterInterface
{

    /**
     * @inheritDoc
     */
    public function toJson(): string
    {
        // TODO: Implement toJson() method.
    }

    public function fromResult(LoginResultInterface $result): LoginPresenterInterface
    {
        // TODO: Implement fromResult() method.
    }

    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        // TODO: Implement getData() method.
    }
}
