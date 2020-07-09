<?php


namespace Domain\Interfaces\Repositories;


use Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function findAllPaginated($page, $size): array;

    public function findByQuery(string $query, array $categories, array $brands, array $provider, int $page, int $size, string $orderBy): array;

    public function persist(Product $product);

    public function findOneById(int $id): ?Product;

    public function findOneByUuid(string $uuid): ?Product;

    public function count(array $criteria);
}
