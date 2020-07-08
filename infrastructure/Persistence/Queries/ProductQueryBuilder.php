<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Queries;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\QueryBuilder;
use Domain\Entities\Product;
use Domain\Enums\SQLOrderEnum;


class ProductQueryBuilder extends EntityRepository
{
    /**
     * @var QueryBuilder
     */
    private $dqlQuery;

    private $products = [];
    private $filteredProducts = [];
    private $order = SQLOrderEnum::ASCENDANT;
    private int $page = 0;
    private int $limit = 10;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Product::class));
        $this->init();
    }

    /**
     * @param string $query
     * @return ProductQueryBuilder
     */
    public function byQuery(string $query): ProductQueryBuilder
    {
        $this->dqlQuery->where('p.name LIKE :query')
            ->orWhere('p.description LIKE :query')
            ->setParameter('query', '%' . $query . '%');

        $this->filteredProducts = $this->dqlQuery->getQuery()->getResult();

        return $this;
    }

    /**
     * @param array $brands
     * @return ProductQueryBuilder
     */
    public function byBrand(array $brands): ProductQueryBuilder
    {
        $this->products = $this->filteredProducts;
        $this->filteredProducts = [];

        if (!$this->products) {
            $this->products = $this->dqlQuery->getQuery()->getResult();
        }

        foreach ($this->products as $product) {
            $productBrands = $product->getBrand()->getName();

            $productBrandsNames = array_map(function ($productBrand) {
                return $productBrand->getName();
            }, $productBrands);

            $hasAllBrand = true;

            foreach ($brands as $brand) {
                if (!in_array($brand, $productBrandsNames)) {
                    $hasAllBrand = false;
                }
            }

            if ($hasAllBrand) {
                $this->filteredProducts[] = $product;
            }
        }
        return $this;
    }

    /**
     * @param array $categories
     * @return ProductQueryBuilder
     */
    public function byCategories(array $categories): ProductQueryBuilder
    {
        $this->products = $this->filteredProducts;
        $this->filteredProducts = [];

        if (!$this->products) {
            $this->filteredProducts = $this->dqlQuery->getQuery()->getResult();
        }

        foreach ($this->products as $product) {
            $productCategories = $product->getCategories();
            $productCategoriesNames = array_map(function ($productCategory) {
                return $productCategory->getName();
            }, $productCategories);

            $hasAllCategories = true;

            foreach ($categories as $category) {
                if (!in_array($category, $productCategoriesNames)) {
                    $hasAllCategories = false;
                }
            }

            if ($hasAllCategories) {
                $this->filteredProducts[] = $product;
            }
        }
        return $this;
    }

    /**
     * @return void
     */
    public function init()
    {
        $this->dqlQuery = $this->createQueryBuilder('p');
    }

    /**
     * @return array
     */
    public function executeQueryBuilder(): array
    {
        return $this->filteredProducts;
    }

    public function addOrderBy(string $order)
    {
        $this->order = $order;
    }

    public function addPageAndLimitBy(int $page, int $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }
}
