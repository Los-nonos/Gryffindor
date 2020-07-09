<?php


namespace Application\Queries\Query\Orders;


use Infrastructure\QueryBus\Query\QueryInterface;

class IndexOrdersQuery implements QueryInterface
{
    private $page;
    private $size;
    private $userId;

    public function __construct($page, $size, $userId)
    {
        $this->page = $page;
        $this->size = $size;
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
