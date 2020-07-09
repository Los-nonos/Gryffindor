<?php


namespace Domain\Interfaces\Repositories;


interface ProductRepositoryInterface
{
    public function findAllPaginated($page, $size): array;

    public function findByQuery(string $query, array $categories, array $brands, array $provider, int $page, int $size, string $orderBy): array;

    public function count(array $criteria);
}
