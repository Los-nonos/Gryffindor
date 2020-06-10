<?php


namespace Application\Queries\Results\Categories;


use Infrastructure\QueryBus\Result\ResultInterface;

class IndexCategoryResult implements ResultInterface
{
    private $categories;

    public function setCategories(array $categories)
    {
        $this->categories = $categories;
    }

    public function getCategories(): array {
        return $this->categories;
    }
}
