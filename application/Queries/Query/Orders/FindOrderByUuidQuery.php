<?php


namespace Application\Queries\Query\Orders;


use Infrastructure\QueryBus\Query\QueryInterface;

class FindOrderByUuidQuery implements QueryInterface
{
    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
