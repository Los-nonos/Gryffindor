<?php


namespace Application\Queries\Query\Providers;


use Infrastructure\QueryBus\Query\QueryInterface;

class FindProviderQuery implements QueryInterface
{
    private int $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}
