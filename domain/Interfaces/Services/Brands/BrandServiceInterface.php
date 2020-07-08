<?php


namespace Domain\Interfaces\Services\Brands;


interface BrandServiceInterface
{
    public function findOneByIdOrFail(int $id): ?Brand;
}
