<?php


namespace Presentation\Interfaces;


use Application\Results\Auth\LoginResultInterface;
use Infrastructure\Presenter\Contracts\PresenterInterface;

interface LoginPresenterInterface extends PresenterInterface
{
    public function fromResult(LoginResultInterface $result): LoginPresenterInterface;
}
