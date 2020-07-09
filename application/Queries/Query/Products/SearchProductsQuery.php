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

    public function __construct(
        ?string $query,
        ?array $categories,
        ?array $brands,
        ?array $providers,
        ?int $page,
        ?int $size,
        ?string $orderBy
    )
    {
        $this->query = $query;
        $this->categories = $categories;
        $this->brands = $brands;
        $this->providers = $providers;
        $this->page = $page;
        $this->size = $size;
        $this->orderBy = $orderBy;
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
}
