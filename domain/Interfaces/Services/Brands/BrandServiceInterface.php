<?php


namespace Domain\Interfaces\Services\Brands;


use Domain\Entities\Brand;

interface BrandServiceInterface
{
    public function findOneByIdOrFail(int $id): Brand;

    public function persist(Brand $brand): void;

    public function findAllPaginated($page, $size): array;

    public function findByNameOrFail(string $name): Brand;
}
