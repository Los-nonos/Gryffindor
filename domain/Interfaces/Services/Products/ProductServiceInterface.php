<?php


namespace Domain\Interfaces\Services\Products;


interface ProductServiceInterface
{
    public function findAll($page, $size): array;

    public function findByQuery($query, $categories, $brands, $provider, $page, $size, $orderBy): array;

    public function count(): int;
}
