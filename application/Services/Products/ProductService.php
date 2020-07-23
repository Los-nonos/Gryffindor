<?php


namespace Application\Services\Products;


use Application\Exceptions\EntityNotFoundException;
use Domain\Entities\Product;
use Domain\Interfaces\Repositories\ProductRepositoryInterface;
use Domain\Interfaces\Repositories\StockRepositoryInterface;
use Domain\Interfaces\Services\Products\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    private ProductRepositoryInterface $repository;

    private StockRepositoryInterface $stockRepository;

    public function __construct(
        ProductRepositoryInterface $repository,
        StockRepositoryInterface $stockRepository
    )
    {
        $this->stockRepository = $stockRepository;
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

    public function findWithLowerStock(?int $value): array
    {
        $value = $value ? $value : 5;
        $stocks = $this->stockRepository->findWithLowerStock($value);
        $products = [];

        foreach ($stocks as $stock) {
            array_push($products, $stock->getProduct());
        }

        return $products;
    }

    public function persist(Product $product): void
    {
        $this->repository->persist($product);
    }

    /**
     * @param int $id
     * @return Product
     * @throws EntityNotFoundException
     */
    public function findOneByIdOrFail(int $id): Product
    {
        $product = $this->repository->findOneById($id);

        if(!$product) {
            throw new EntityNotFoundException("Product with id: $id not found");
        }

        return $product;
    }

    /**
     * @param string $uuid
     * @return Product
     * @throws EntityNotFoundException
     */
    public function findOneByUuidOrFail(string $uuid): Product
    {
        $product = $this->repository->findOneByUuid($uuid);

        if(!$product) {
            throw new EntityNotFoundException("Product with uuid: $uuid not found");
        }

        return $product;
    }

    public function modifyProductsStock($products): array
    {
        $productList = [];

        foreach ($products as $product) {
            $productObject = $this->findOneByIdOrFail($product['id']);
            $stock = $productObject->getStock();

            $quantity = $stock->getQuantity();
            $stock->setQuantity($quantity - $product['quantity']);

            array_push($productList, $productObject);

            $this->persist($productObject);
        }

        return $productList;
    }
}
