<?php


namespace Presentation\Http\Presenters\Providers;


use Application\Queries\Results\Providers\IndexProvidersResult;

class IndexProvidersPresenter
{
    private IndexProvidersResult $result;

    public function fromResult($result): IndexProvidersPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array
    {
        $providersList = [];
        $providers = $this->result->getProviders();

        foreach ($providers as $provider) {
            array_push($providersList, [
                'id' => $provider->getId(),
                'name' => $provider->getName(),
                'businessName' => $provider->getBusinessName(),
                'address' => $provider->getAddress(),
                'zipCode' => $provider->getZipCode(),
                'phoneNumber' => $provider->getPhoneNumber(),
                'observations' => $provider->getObservations(),
            ]);
        }

        return $providersList;
    }
}
