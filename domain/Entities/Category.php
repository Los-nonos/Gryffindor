<?php


namespace Domain\Entities;


use Doctrine\Common\Collections\ArrayCollection;

class Category
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Filter[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param Filter $filters
     */
    public function addFilters(Filter $filters): void
    {
        if(!$this->filters) {
            $this->filters = new ArrayCollection();
        }

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
