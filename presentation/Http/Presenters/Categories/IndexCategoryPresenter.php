<?php


namespace Presentation\Http\Presenters\Categories;


use Application\Queries\Results\Categories\IndexCategoryResult;

class IndexCategoryPresenter
{
    /**
     * @var IndexCategoryResult
     */
    private $result;

    public function fromResult($result): IndexCategoryPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $data = $this->result->getCategories();
        $cleanData = [];

        foreach ($data as $category) {
            array_push($cleanData, [
                'name' => $category->getName(),
                'filters' => array(
                    'name' => $category->getFilters()[0]->getName(),
                    'options' => $category->getFilters()[0]->getOptions()[0],
                ),
            ]);
        }

        return $cleanData;
    }
}
