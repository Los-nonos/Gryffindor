<?php


namespace Application\Queries\Results\Products;


use Domain\Entities\Product;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindProductResult implements ResultInterface
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}
