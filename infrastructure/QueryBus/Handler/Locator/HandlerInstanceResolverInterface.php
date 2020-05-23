<?php


namespace Infrastructure\QueryBus\Handler\Locator;


interface HandlerInstanceResolverInterface
{
    public function getCallable(): callable;
}
