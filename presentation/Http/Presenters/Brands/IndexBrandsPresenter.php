<?php


namespace Presentation\Http\Presenters\Brands;


use Application\Queries\Results\Brands\IndexBrandsResult;

class IndexBrandsPresenter
{
    private IndexBrandsResult $result;

    public function fromResult($result): IndexBrandsPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $brandsList = [];
        $brands = $this->result->getBrands();
        foreach ($brands as $brand) {
            array_push($brandsList, [
                'id' => $brand->getId(),
                'name' => $brand->getName(),
                'description' => $brand->getDescription(),
            ]);
        }
        return $brandsList;
    }
}
