<?php


namespace Application\Services\Products;


use Domain\Interfaces\Repositories\ProductRepositoryInterface;
use Domain\Interfaces\Services\Products\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findAll($page, $size): array
    {
        $page = $page ? $page : 1;
        $size = $size ? $size : 10;

        return $this->repository->findAllPaginated($page, $size);
    }

    public function findByQuery($query, $categories, $brands, $provider, $page, $size, $orderBy): array
    {
        $page = $page ? $page : 1;
        $size = $size ? $size : 10;

        return $this->repository->findByQuery($query, $categories, $brands, $provider, $page, $size, $orderBy);
    }

    public function count(): int
    {
        return $this->repository->count([]);
    }
}
