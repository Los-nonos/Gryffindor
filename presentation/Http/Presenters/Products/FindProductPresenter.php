<?php


namespace Presentation\Http\Presenters\Products;


use Application\Queries\Results\Products\FindProductResult;
use Domain\Entities\Provider;

class FindProductPresenter
{
    private FindProductResult $result;

    public function fromResult($result): FindProductPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $product = $this->result->getProduct();

        return [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
            'description' => $product->getDescription(),
            'images' => $this->getImages($product->getCharacteristics()),
            'price' => [
                'amount' => ($product->getPrice()->add($product->getTaxes())->getAmount() / 100),
                'currency' => $product->getPrice()->getCurrency()
            ],
            'taxes' => [
                'amount' => ($product->getTaxes()->getAmount() / 100),
                'currency' => $product->getPrice()->getCurrency()
            ],
            'characteristics' => $this->getCharacteristics($product->getCharacteristics()),
            'categories' => $this->getCategories($product->getCategories()),
            'brand' => $this->getBrands($product->getBrands()),
            'provider' => $this->getProvider($product->getProviders()),
            'stock' => $product->getStock()->getQuantity(),
            'purchaseOrderNumber' => $product->getPurchaseOrder()[0]->getPurchaseNumber(),
        ];
    }

    private function getCategories($categories):array {
        $categoriesList = [];

        if(!$categories) {
            return $categoriesList;
        }


        foreach ($categories as $category) {
            array_push($categoriesList, [
                'id' => $category->getId(),
                'name' => $category->getName(),
            ]);
        }

        return $categoriesList;
    }

    private function getCharacteristics($characteristics) {
        $characteristicsList = [];

        if(!$characteristics) {
            return $characteristicsList;
        }


        foreach ($characteristics as $characteristic) {
            if($characteristic->getName() !== 'image') {
                array_push($characteristicsList, [
                    'id' => $characteristic->getId(),
                    'name' => $characteristic->getName(),
                    'value' => $characteristic->getProperty(),
                ]);
            }
        }

        return $characteristicsList;
    }

    private function getImages($characteristics) {
        $imagesList = [];

        if(!$characteristics) {
            return $imagesList;
        }


        foreach ($characteristics as $characteristic) {
            if($characteristic->getName() === 'image') {
                array_push($imagesList, $characteristic->getProperty());
            }
        }

        return $imagesList;
    }

    private function getBrands($brands)
    {
        $brandList = [];

        if (!$brands) {
            return $brandList;
        }

        array_push($brandList, [
            'id' => $brands->getId(),
            'name' => $brands->getName(),
        ]);

        return $brandList;
    }

    /**
     * @param Provider[] $providers
     * @return array
     */
    private function getProvider(array $providers)
    {
        $providerList = [];

        foreach ($providers as $provider) {
            array_push($providerList, [
                'id' => $provider->getId(),
                'name' => $provider->getName(),
                'businessName' => $provider->getBusinessName(),
            ]);
        }

        return $providerList;
    }
}
