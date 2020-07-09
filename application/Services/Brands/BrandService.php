<?php


namespace Application\Services\Brands;


use Domain\Interfaces\Services\Brands\Brand;
use Domain\Interfaces\Services\Brands\BrandServiceInterface;

class BrandService implements BrandServiceInterface
{

    public function findOneByIdOrFail(int $id): ?Brand
    {
        
    }
}
