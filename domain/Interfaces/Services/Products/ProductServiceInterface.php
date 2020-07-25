<?php


namespace Domain\Interfaces\Services\Products;


use Domain\Entities\Product;

interface ProductServiceInterface
{
    public function findAll($page, $size): array;

    public function findByQuery($query, $categories, $brands, $provider, $page, $size, $orderBy, $minPrice, $maxPrice): array;

    public function count(): int;

    public function findWithLowerStock(?int $value): array;

    public function persist(Product $product): void;

    public function findOneByIdOrFail(int $id): Product;

    public function findOneByUuidOrFail(string $uuid): Product;

    public function modifyProductsStock($products): array;
}
