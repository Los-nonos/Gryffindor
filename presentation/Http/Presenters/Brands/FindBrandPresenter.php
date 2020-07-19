<?php


namespace Presentation\Http\Presenters\Brands;


use Application\Queries\Results\Brands\FindBrandResult;

class FindBrandPresenter
{
    private FindBrandResult $result;

    public function fromResult($result): FindBrandPresenter {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $brand = $this->result->getBrand();
        return [
            'id' => $brand->getId(),
            'name' => $brand->getName(),
            'description' => $brand->getDescription(),
            'products' => $this->clearProducts($brand->getProducts()),
            'providers' => $this->clearProviders($brand->getProviders())
        ];
    }

    private function clearProducts($products)
    {
        $productsList = [];

        foreach ($products as $product) {
            array_push($productsList, [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
            ]);
        }

        return $productsList;
    }

    private function clearProviders($providers)
    {
        $providersList = [];

        foreach ($providers as $provider) {
            array_push($providersList, [
                'id' => $provider->getId(),
                'name' => $provider->getName(),
            ]);
        }

        return $providersList;
    }
}
