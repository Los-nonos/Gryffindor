<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Brand;

interface BrandRepositoryInterface
{
    public function persist(Brand $brand): void;

    public function findOneById(int $id): ?Brand;

    public function findOneByName(string $name): ?Brand;

    public function findAllPaginated(int $page, int $size): array;
}
