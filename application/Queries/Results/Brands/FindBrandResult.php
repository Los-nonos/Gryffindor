<?php


namespace Application\Queries\Results\Brands;


use Domain\Entities\Brand;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindBrandResult implements ResultInterface
{
    private Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }
}
