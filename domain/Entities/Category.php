<?php


namespace Domain\Entities;


class Category
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Filter[]
     */
    private $filters;

    /**
     * @var Product[]
     */
    private $products;

    /**
     * Category constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Filter[]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @param Filter $filters
     */
    public function addFilters(Filter $filters): void
    {
        $this->filters[] = $filters;
    }

    public function removeFilter(Filter $filter): void
    {
        // TODO: implement
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product $products
     */
    public function addProducts(Product $products): void
    {
        $this->products[] = $products;
    }

    public function removeProduct(Product $product): void
    {
        // TODO: implement
    }
}
