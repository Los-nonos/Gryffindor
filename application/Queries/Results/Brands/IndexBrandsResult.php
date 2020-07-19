<?php


namespace Application\Queries\Results\Brands;


use Domain\Entities\Brand;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexBrandsResult implements ResultInterface
{
    /**
     * @var Brand[]
     */
    private $brands;

    public function __construct($brands)
    {
        $this->brands = $brands;
    }

    /**
     * @return Brand[]
     */
    public function getBrands()
    {
        return $this->brands;
    }
}
