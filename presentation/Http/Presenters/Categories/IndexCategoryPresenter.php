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
                'id' => $category->getId(),
                'name' => $category->getName(),
                'filters' => $this->clearFilters($category->getFilters()),
            ]);
        }
        logger($cleanData);
        return $cleanData;
    }

    private function clearOptions($data): array {
        $clearData = [];
        if(!isset($data) && !is_array($data)) {
            return $clearData;
        }


        foreach ($data as $option) {
            array_push($clearData, [
                'name' => $option->getName() ? $option->getName() : null,
            ]);
        }
        return $clearData;
    }

    private function clearFilters($filters): array {
        $clear_filters = [];

        foreach ($filters as $filter) {
            array_push($clear_filters, [
                'id' => $filter->getId(),
                'name' => $filter->getName(),
                'options' => $this->clearOptions($filter->getOptions())
            ]);
        }
        return $clear_filters;
    }
}
