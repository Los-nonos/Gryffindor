<?php


namespace Application\Queries\Query\Customers;


use Infrastructure\QueryBus\Query\QueryInterface;

class IndexCustomerQuery implements QueryInterface
{
    private $page;
    private $size;
    private $name;
    private $dni;
    private $cuil;

    public function __construct($page, $size, $name, $dni, $cuil)
    {
        $this->page = $page;
        $this->size = $size;
        $this->name = $name;
        $this->dni = $dni;
        $this->cuil = $cuil;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @return mixed
     */
    public function getCuil()
    {
        return $this->cuil;
    }
}
