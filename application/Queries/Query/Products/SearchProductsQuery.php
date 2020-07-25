<?php


namespace Application\Queries\Query\Products;


use Infrastructure\QueryBus\Query\QueryInterface;

class SearchProductsQuery implements QueryInterface
{
    private ?string $query;
    private ?array $categories;
    private ?array $brands;
    private ?array $providers;
    private ?int $page;
    private ?int $size;
    private ?string $orderBy;
    private ?int $minPrice;
    private ?int $maxPrice;

    public function __construct(
        ?string $query,
        ?array $categories,
        ?array $brands,
        ?array $providers,
        ?int $page,
        ?int $size,
        ?string $orderBy,
        ?int $minPrice,
        ?int $maxPrice
    )
    {
        $this->query = $query;
        $this->categories = $categories;
        $this->brands = $brands;
        $this->providers = $providers;
        $this->page = $page;
        $this->size = $size;
        $this->orderBy = $orderBy;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return string|null
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * @return array|null
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }

    /**
     * @return array|null
     */
    public function getBrands(): ?array
    {
        return $this->brands;
    }

    /**
     * @return array|null
     */
    public function getProviders(): ?array
    {
        return $this->providers;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @return int|null
     */
    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }
}
